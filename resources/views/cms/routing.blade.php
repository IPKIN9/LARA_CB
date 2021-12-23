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
    <h2 class="mb-4">Routing</h2>
    <div class="row">
        <div class="col-lg-12">
            <button id="add-routing" class="mb-4 btn btn-md btn-primary">Tambah Data</button>
            <table id="routing-table" class="table table-striped table-bordered" style="width:100%">
                <thead class="text-center">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Button Click</th>
                        <th style="width: 500px;">message</th>
                        <th>next</th>
                        <th style="width: 120px;">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data['routing'] as $d)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                @if ($d->button_click == null)
                                    No button click
                                @else
                                    {{ $d->detail->content }}
                                @endif</strong>
                            </td>
                            <td>{{ $d->message->content }}</td>
                            <td>
                                @if ($d->next_message == null)
                                    Route type is end or from
                                @else
                                    {{ $d->next_message->content }}
                                @endif
                            </td>
                            <td>
                                @if ($d->type_route == 'first')
                                    <button disabled class="btn btn-sm btn-secondary">Del</button>
                                @else
                                    <button id="delete-message" data-id="{{ Crypt::encrypt($d->id) }}"
                                        class="btn btn-sm btn-danger">Del</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Button Click</th>
                        <th style="width: 500px;">message</th>
                        <th>next</th>
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

            $('#routing-table').DataTable();

            $(document).on('click', '#add-routing', function() {
                $('.modal-title').html('Set Routing');
                $('#input-form').attr('action', "{{ route('routing.create') }}");
                $('.modal-body').html('');
                $('.modal-body').append(`
                    <div class="row mr-2 ml-2">
                        <div class="col-md-12 form-group mb-2">
                            <label for="">Type Routing</label>
                            <select class="form-control form-primary" name="type_route" id="type_response">
                                <option selected disabled>--Select--</option>
                                <option value="first">First</option>
                                <option value="continue">Continue</option>
                                <option value="end">End</option>
                            </select>
                        </div>
                    </div>
                    <div id="form-set" class="row mt-4 mr-2 ml-2">
                    </div>
                `);
                $('#myModal').modal('show');
                $('#type_response').on('change', function() {
                    let val = $('#type_response').val();
                    let form_button = `
                        <div class="col-md-12 form-group" id="form_button_click">
                            <label for="">Button Click</label>
                            <select class="form-control form-primary" name="button_click" id="button_click">
                                <option selected disabled>--Select--</option>
                                @foreach ($data['detail'] as $d)
                                    <option value="{{ $d->id }}">{{ $d->content }}</option>
                                @endforeach
                            </select>
                        </div>`;
                    let form_message = `
                        <div class="col-md-12 form-group">
                            <label for="">Message Response</label>
                            <select class="form-control form-primary" name="message_response" id="message_response">
                                <option selected disabled>--Select--</option>
                                @foreach ($data['message'] as $d)
                                    <option value="{{ $d->id }}">{{ $d->content }}</option>
                                @endforeach
                            </select>
                        </div>`;
                    let form_next = `
                        <div class="col-md-12 form-group" id="form-next">
                            <label for="">Next Response</label>
                            <select class="form-control form-primary" name="next_response" id="next_response">
                                <option selected disabled>--Select--</option>
                                @foreach ($data['choice'] as $d)
                                    <option value="{{ $d->id }}">{{ $d->content }}</option>
                                @endforeach
                            </select>
                        </div>`;
                    switch (val) {
                        case 'first':
                            $('#form-set').html('');
                            $('#form-set').append(form_message);
                            $('#form-set').append(form_next);
                            break;

                        case 'continue':
                            $('#form-set').html('');
                            $('#form-set').append(form_button);
                            $('#form-set').append(form_message);
                            $('#form-set').append(form_next);
                            break;

                        default:
                            $('#form-set').html('');
                            $('#form-set').append(form_button);
                            $('#form-set').append(form_message);
                            break;
                    }
                });
            });

            $(document).on('click', '#delete-message', function() {
                let id = $(this).data('id');
                let url = "routing/delete/" + id;
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
