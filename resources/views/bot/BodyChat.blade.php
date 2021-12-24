@extends('bot.ChatBot');
@section('content')
    <div class="chat-body hide" id="body-myChatBot" style="overflow: auto;">
        <div class="chat-bubble you">
            Datamu tidak lengkap
        </div>
        <div class="chat-bubble me">Hi, I am back</div>
    </div>
@endsection
@section('js')
    <script>
        const date = new Date();
        let time = "";
        setInterval(() => {
            const date = new Date();
            time = date.getMinutes() + "-" + date.getSeconds() + "-" + date.getMilliseconds();
        }, 800);
        const loadChat = `
        <div class="chat-bubble you" id="loading-chat">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                style="margin: auto;display: block;shape-rendering: auto;width: 43px;height: 20px;" viewBox="0 0 100 100"
                preserveAspectRatio="xMidYMid">
                <circle cx="0" cy="44.1678" r="15" fill="#ffffff">
                    <animate attributeName="cy" calcMode="spline" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5"
                        repeatCount="indefinite" values="57.5;42.5;57.5;57.5" keyTimes="0;0.3;0.6;1" dur="1s" begin="-0.6s">
                    </animate>
                </circle>
                <circle cx="45" cy="43.0965" r="15" fill="#ffffff">
                    <animate attributeName="cy" calcMode="spline" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5"
                        repeatCount="indefinite" values="57.5;42.5;57.5;57.5" keyTimes="0;0.3;0.6;1" dur="1s"
                        begin="-0.39999999999999997s">
                    </animate>
                </circle>
                <circle cx="90" cy="52.0442" r="15" fill="#ffffff">
                    <animate attributeName="cy" calcMode="spline" keySplines="0 0.5 0.5 1;0.5 0 1 0.5;0.5 0.5 0.5 0.5"
                        repeatCount="indefinite" values="57.5;42.5;57.5;57.5" keyTimes="0;0.3;0.6;1" dur="1s"
                        begin="-0.19999999999999998s">
                    </animate>
                </circle>
            </svg>
        </div>`;


        $(document).on('click', '#btn-start', function() {
            let url = 'api/first_message';
            $('#body-myChatBot').html('');
            $('#body-myChatBot').append(loadChat);
            $.get(url, function(result) {
                setTimeout(() => {
                    if (result.count >= 1) {
                        $('#loading-chat').remove();
                        $('#body-myChatBot').append(`
                            <div class="chat-bubble you">` + result.route.message.content + `.
                                ` + result.route.next_message.content + `
                                <div class="col text-center mt-2" id="this-` + result.route.id + `">
                                    
                                </div>
                            </div>
                            `);
                        $.each(result.next, function(v, i) {
                            $('#this-' + result.route.id).append(
                                `
                            <button onclick="requestNext(this)" data-id="` + i.id + `" data-content="` +
                                i.content + `" class="btn btn-sm mr-1 mt-2">` + i
                                .content + `</button>
                            `);
                        });
                    } else {
                        $('#loading-chat').remove();
                        $('#body-myChatBot').append(`
                            <div class="chat-bubble you">
                                Pesan tidak ditemukan
                            </div>
                        `);
                    }
                }, 1000);
            });
        });

        function requestNext(d) {
            $(d).prop('disabled', 'true');
            let dataID = $(d).data('id');
            let dataContent = $(d).data('content');
            let url = "api/next/" + dataID;
            $('#body-myChatBot').append(`
                <div id="div-me` + time + `" class="chat-bubble me mt-2">` + dataContent + `</div>
            `);
            var elmnt = document.getElementById("div-me" + time);
            elmnt.scrollIntoView();
            setTimeout(() => {
                $('#body-myChatBot').append(loadChat);
                $.get(url, function(result) {
                    $('#loading-chat').remove();

                    if (result.count >= 1) {
                        $('#loading-chat').remove();
                        switch (result.route.message.type_message) {
                            case 'continue':
                                $('#body-myChatBot').append(`
                                <div id="div-` + time + `" class="chat-bubble you">` + result.route.message.content + `.
                                    ` + result.route.next_message.content + `
                                    <div class="col text-center mt-2" id="this-` + result.route.id + `">
                                        
                                    </div>
                                </div>
                                `);
                                if (result.next.length >= 1) {
                                    $.each(result.next, function(v, i) {
                                        $('#this-' + result.route.id).append(
                                            `
                                    <button onclick="requestNext(this)" data-id="` + i.id + `" data-content="` +
                                            i.content + `" class="btn btn-sm mr-1 mt-2">` + i
                                            .content + `</button>
                                    `);
                                    });
                                }
                                var elmnt = document.getElementById("div-" + time);
                                elmnt.scrollIntoView();
                                break;

                            case 'form':
                                $('#body-myChatBot').append(`
                                <div id="div-` + time + `" class="chat-bubble you">` + result.route.message.content + `.
                                    <div class="form-group mt-2">
                                        <label for="" class="text-light">Nim</label>
                                        <input class="form-control" type="text" name="nim" id="nim" placeholder="--input here--">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-light">Nama</label>
                                        <input class="form-control" type="text" name="nama" id="nama" placeholder="--input here--">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-light">Kls</label>
                                        <input class="form-control" type="text" name="kls" id="kls" placeholder="--input here--">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-light">Jurusan</label>
                                        <input class="form-control" type="text" name="jurusan" id="jurusan" placeholder="--input here--">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-light">Masukan</label>
                                        <textarea class="form-control" name="masukan" id="masukan" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button id="btn-sendForm" type="submit" class="btn btn-sm">Kirim</button>
                                    </div>
                                </div>
                                `);
                                var elmnt = document.getElementById("div-" + time);
                                elmnt.scrollIntoView();
                                $(document).scrollTop($(document).height());
                                break;

                            default:
                                $('#body-myChatBot').append(`
                                <div id="div-` + time + `" class="chat-bubble you">` + result.route.message.content + `. Akhiri?
                                    <div class="col text-center mt-2">
                                        <button onclick="
                                        setTimeout(() => {
                                            $('.end-chat').trigger('click');
                                        }, 600);
                                        " class="btn btn-sm mr-1 mt-2">Akhiri</button>
                                        <button onclick="
                                        setTimeout(() => {
                                            $('#btn-start').trigger('click');
                                        }, 600);
                                        " class="btn btn-sm mr-1 mt-2">Ulangi</button>
                                    </div>
                                </div>
                                `);
                                var elmnt = document.getElementById("div-" + time);
                                elmnt.scrollIntoView();
                                break;
                        }
                    } else {
                        $('#body-myChatBot').append(`
                            <div id="div-` + time + `" class="chat-bubble you">
                                Pesan tidak ditemukan
                            </div>
                        `);
                        var elmnt = document.getElementById("div-" + time);
                        elmnt.scrollIntoView();
                    }
                });
            }, 600);
        }

        $(document).on('click', '#btn-sendForm', function() {
            $('.form-control').prop('disabled', 'true');
            $('#btn-sendForm').prop('disabled', 'true');
            $('#btn-sendForm').attr('id', '');
            $('#body-myChatBot').append(`
            <div id="div-me` + time + `" class="chat-bubble me">Sendding</div>
            `);
            var elmnt = document.getElementById("div-me" + time);
            elmnt.scrollIntoView();
            let url = "api/form";
            let data = {
                nim: $('#nim').val(),
                nama: $('#nama').val(),
                kls: $('#kls').val(),
                jurusan: $('#jurusan').val(),
                masukan: $('#masukan').val(),
            }
            $('#body-myChatBot').append(loadChat);
            var elmnt = document.getElementById("loading-chat");
            elmnt.scrollIntoView();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(result) {
                    if (result.code == '201') {

                        setTimeout(() => {
                            $('#loading-chat').remove();
                            $('.chat-body').addClass('hide');
                            $('.chat-input').addClass('hide');
                            $('.chat-session-end').removeClass('hide');
                            $('.chat-header-option').addClass('hide');
                        }, 600);
                    } else {
                        $('#loading-chat').remove();
                        $('#body-myChatBot').append(`
                        <div id="div-` + time + `" class="chat-bubble you">
                            Datamu tidak lengkap
                        </div>
                        `);
                        var elmnt = document.getElementById("div-" + time);
                        elmnt.scrollIntoView();
                        setTimeout(() => {
                            $('#btn-start').trigger('click');
                        }, 1000);
                    }
                }
            });

        });
    </script>
@endsection
