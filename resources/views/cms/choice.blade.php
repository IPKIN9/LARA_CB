@extends('template.CmsTemplate')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <p class="text-danger">Periksa inputan anda sebelum mengirim</p>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="mb-4">Choice</h2>
    <div class="row">
        <div class="col-lg-12">
            <button id="add-message" class="mb-4 btn btn-md btn-primary">Tambah Data</button>
            <table id="choice" class="table table-striped table-bordered" style="width:100%">
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
                            <td>{{ $d->content }}</td>
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
            const d = new Date();
            let time = d.getTime();

            $('#choice').DataTable();
            $(document).on('click', '#add-message', function() {
                $('.modal-title').html('Create New Data');
                $('.modal-body').html('');
                $('.modal-body').append(`
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Content</label>
                        <textarea class="form-height" name="content" id="input-content" >--Replace this word--</textarea>
                    </div>
                    <hr>
                    <div class="col-md-12 form-group mt-4">
                        <button type="button" id="add-detail" class="btn btn-sm btn-secondary">Add detail</button>
                    </div>
                    <div id="detail-content" class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="">Detail For Next Message</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-primary">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-sm btn-secondary mt-2">remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                `);
                $('#input-form').attr('action', "{{ route('message.create') }}");
                $('#input-form').attr('method', 'POST');
                $('#myModal').modal('show');

                $(document).on('click', '#add-detail', function() {
                    $('#detail-content').append(`
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="">Detail For Next Message</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-primary">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-secondary mt-2">remove</button>
                            </div>
                        </div>
                    `);
                });
            });
        });
    </script>
@endsection
