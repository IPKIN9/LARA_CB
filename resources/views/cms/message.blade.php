@extends('template.CmsTemplate')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <p class="text-danger">Periksa inputan anda sebelum mengirim</p>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="mb-4">Message</h2>
    <div class="row">
        <div class="col-lg-12">
            <button id="add-message" class="mb-4 btn btn-md btn-primary">Tambah Data</button>
            <table id="message" class="table table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Content</th>
                        <th style="width: 120px;">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $d->content }} <br> <strong>type is: {{ $d->type_message }}</strong></td>
                            <td>
                                <button id="edit-message" data-id="{{ Crypt::encrypt($d->id) }}"
                                    class="btn btn-sm btn-primary">Edit</button>
                                <button id="delete-message" data-id="{{ Crypt::encrypt($d->id) }}"
                                    class="btn btn-sm btn-danger">Del</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Content</th>
                        <th style="width: 120px;">Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#message').DataTable();

            $(document).on('click', '#add-message', function() {
                $('.modal-title').html('Create New Data');
                $('.modal-body').html('');
                $('.modal-body').append(`
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Content</label>
                        <textarea class="form-height" name="content" id="input-content" >--Replace this word--</textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Type Message</label>
                        <select class="form-control" name="type_message" id="type_message">
                            <option selected disabled>--Select--</option>
                            <option value="first">First</option>
                            <option value="continue">Continue</option>
                            <option value="form">Form</option>
                            <option value="end">End</option>
                        </select>
                    </div>
                </div>
                `);
                $('#input-form').attr('action', "{{ route('message.create') }}");
                $('#input-form').attr('method', 'POST');
                $('#myModal').modal('show');
            });

            $(document).on('click', '#edit-message', function() {
                let id = $(this).data('id');
                let url = 'message/getById/' + id;
                $.get(url, function(result) {
                    $('.modal-title').html('Update Data');
                    $('.modal-body').html('');
                    $('.modal-body').append(`
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Content</label>
                            <textarea class="form-height" name="content" id="input-content" >` + result.content + `</textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Type Message</label>
                            <select class="form-control" name="type_message" id="type_message">
                                <option selected disabled>--Select--</option>
                                <option value="first">First</option>
                                <option value="continue">Continue</option>
                                <option value="form">Form</option>
                                <option value="end">End</option>
                            </select>
                        </div>
                    </div>
                    `);
                    $('#type_message').val(result.type_message);
                    $('#input-form').attr('action', `message/update/` + result.id + ``);
                    $('#input-form').attr('method', 'POST');
                    $('#myModal').modal('show');
                });
            });

            $(document).on('click', '#delete-message', function() {
                let id = $(this).data('id');
                let url = "message/delete/" + id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            success: function() {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Success to delete data.',
                                    icon: 'success',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Oke'
                                }).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Ada yang salah!',
                                });
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
