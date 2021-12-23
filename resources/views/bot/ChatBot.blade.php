<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome to chatbot </title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('bot/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bot/css/main.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('bot/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bot/css/chatBot.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('bot/css/timeline.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Chat bot UI start -->
    <div class="chat-screen">
        <div class="chat-header">
            <div class="chat-header-title">
                Selamat datang di layanan Chat Bot
            </div>
            <div class="chat-header-option hide">
                <span class="dropdown custom-dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-more-horizontal">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1"
                        style="will-change: transform;">
                        <a class="dropdown-item end-chat" href="javascript:void(0);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="#bc32ef" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-power">
                                <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                <line x1="12" y1="2" x2="12" y2="12"></line>
                            </svg>
                            End Chat
                        </a>
                    </div>
                </span>
            </div>
        </div>
        <div class="chat-mail">
            <div class="row">
                <div class="col-md-12 text-center mb-2">
                    <p>Klik start untuk memulai</p>
                </div>
            </div>
            <div class="row" style="height: 200px;">
                <div class="col-md-12 mt-4">
                    <button id="btn-start" class="btn btn-primary btn-rounded btn-block">Start Chat</button>
                </div>
                <div class="col-md-12">
                    <div class="powered-by">Powered by css3transition</div>
                </div>
            </div>
        </div>
        @yield('content')
        <div class="chat-input hide">
            <input type="text" placeholder="Type a message...">
            <div class="input-action-icon">
                <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-paperclip">
                        <path
                            d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                        </path>
                    </svg></a>
                <a><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-send">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg></a>
            </div>
        </div>
        <div class="chat-session-end hide">
            <h5>Terima kasih telah menggunakan layanan Chat Bot kami</h5>
            <p>Sampai jumpa dilain waktu</p>
            <div class="rate-me">
                <div class="rate-bubble great">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-thumbs-up mt-3">
                            <path
                                d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3">
                            </path>
                        </svg></span>
                    Great
                </div>
                <div class="rate-bubble bad">
                    <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-thumbs-down mt-3">
                            <path
                                d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17">
                            </path>
                        </svg></span>
                    Bad
                </div>
            </div>
            <div class="powered-by">Powered by css3transition</div>
        </div>
    </div>
    <div class="chat-bot-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-message-square animate">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-x ">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </div>
    <!-- Chat Bot UI Ends -->
    <!-- Time line Html Start -->
    <h1 class="hide">Responsive Timeline using Flexbox</h1>
    <div class="timeline hide">
        <div class="timeline-item">
            <div class="timeline-date">
                <img src="stylesheet/images/cities/delhi.svg" />
                <div>
                    January 2019
                </div>
            </div>
            <div class="timeline-content">
                <h2>Journey Start <span>(Delhi)</span></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad saepe nulla quibusdam ut. Beatae, facere
                    sequi blanditiis porro suscipit tempore ipsam iste ipsa, culpa quam vero, dolorem cupiditate. Magni,
                    numquam?<button type="button" class="visit">Visit ›</button><img
                        src="stylesheet/images/cities/delhi.svg" /></p>
                <br>
                <i class="fas fa-rocket fa-icon"></i>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-date">
                <img src="stylesheet/images/cities/lucknow.svg" />
                <div>
                    February 2019
                </div>
            </div>
            <div class="timeline-content">
                <h2>Nawabo ka Sehar<span>(Lucknow)</span></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad saepe nulla quibusdam ut. Beatae, facere
                    sequi blanditiis porro suscipit tempore ipsam iste ipsa, culpa quam vero, dolorem cupiditate. Magni,
                    numquam?<button type="button" class="visit">Visit ›</button><img
                        src="stylesheet/images/cities/lucknow.svg" /></p>

                <br>
                <i class="fas fa-graduation-cap fa-icon"></i>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-date">
                <img src="stylesheet/images/cities/prayagraj.svg" />
                <div>
                    March 2019
                </div>
            </div>
            <div class="timeline-content">
                <h2>Devotional Place<span>(Prayagraj)</span></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad saepe nulla quibusdam ut. Beatae, facere
                    sequi blanditiis porro suscipit tempore ipsam iste ipsa, culpa quam vero, dolorem cupiditate. Magni,
                    numquam?<button type="button" class="visit">Visit ›</button><img
                        src="stylesheet/images/cities/prayagraj.svg" /></p>

                <br>
                <i class="fas fa-power-off fa-icon"></i>
            </div>
        </div>
    </div>
    <script type="257be86a981729866f2fa61c-text/javascript">
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-83834093-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="257be86a981729866f2fa61c-|49" defer=""></script>
    <!-- Time line Html Ends -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('bot/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bot/js/popper.min.js') }}"></script>
    <script src="{{ asset('bot/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bot/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Toggle fullscreen
            $(".chat-bot-icon").click(function(e) {
                $(this).children('img').toggleClass('hide');
                $(this).children('svg').toggleClass('animate');
                $('.chat-screen').toggleClass('show-chat');
            });
            $('.chat-mail button').click(function() {
                $('.chat-mail').addClass('hide');
                $('.chat-body').removeClass('hide');
                $('.chat-input').removeClass('hide');
                $('.chat-header-option').removeClass('hide');
            });
            $('.end-chat').click(function() {
                $('.chat-body').addClass('hide');
                $('.chat-input').addClass('hide');
                $('.chat-session-end').removeClass('hide');
                $('.chat-header-option').addClass('hide');
            });
        });
    </script>
    @yield('js')
</body>

</html>
