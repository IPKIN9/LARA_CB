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
<h2 class="mb-4">Masukan</h2>
<div class="row">
    <div class="col-lg-12">
        <table id="masukan-table" class="table table-striped table-bordered" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 500px;">NIM</th>
                    <th style="width: 500px;">Nama</th>
                    <th style="width: 500px;">Kelas</th>
                    <th style="width: 500px;">Jurusan</th>
                    <th style="width: 500px;">Masukan</th>
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
                    <td>{{ $d->nim}}</td>
                    <td>{{ $d->nama}}</td>
                    <td>{{ $d->kls}}</td>
                    <td>{{ $d->jurusan}}</td>
                    <td>{{ $d->masukan}}</td>
                    <td>
                        <button id="delete-message" data-id="{{ Crypt::encrypt($d->id) }}"
                            class="btn btn-sm btn-danger">Del</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="text-center">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 500px;">NIM</th>
                    <th style="width: 500px;">Nama</th>
                    <th style="width: 500px;">Kelas</th>
                    <th style="width: 500px;">Jurusan</th>
                    <th style="width: 500px;">Masukan</th>
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

            $('#masukan-table').DataTable();

            $(document).on('click', '#delete-message', function() {
                let id = $(this).data('id');
                let url = "masukan/delete/" + id;
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