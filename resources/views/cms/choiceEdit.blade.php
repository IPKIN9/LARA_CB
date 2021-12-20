@extends('template.CmsTemplate');
@section('content')
    <h2 class="mb-4">Choice Edit</h2>
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
    <form action="{{ route('choice.update', Crypt::encrypt($data['choice']->id)) }}" method="POST">
        @csrf
        <div class="row mb-2">
            <div class="col-md-12 form-group">
                <label for="">Choice Content</label>
                <textarea name="content" id=""
                    style="width: 100%; height: 150px;">{{ $data['choice']->content }}</textarea>
            </div>
        </div>
        <hr>
        <h5 class="mt-4">All Detail</h5>
        <div class="row mt-3">
            <div class="form-group col-md-12">
                @foreach ($data['detail'] as $d)
                    <div class="row mt-2">
                        <div class="col-sm-3 text-left">
                            <label for="">Choice Content</label>
                        </div>
                        <div class="col-sm-9 text-right">
                            <input type="hidden" name="detail_id[]" value="{{ Crypt::encrypt($d->id) }}">
                            <input name="detail_content[]" type="text" class="form-control form-primary"
                                value="{{ $d->content }}">
                            <button data-id="{{ Crypt::encrypt($d->id) }}" id="btn-del" class="btn btn-sm btn-danger mt-2"
                                type="button">Del</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="row mt-3">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('choice.index') }}" class="btn btn-secondary">Close</a>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '#btn-del', function() {
                let id = $(this).data('id');
                let url = "/choice/deletedetail/" + id;
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
