@extends('layouts.app')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Data Gaji Lembur</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{ route('gaji-lembur.create', $gaji->uuid) }}" class="btn btn-sm btn-primary mb-3">Tambah
                            Data</a>
                        <form action="{{ route('gaji.update-lembur', $gaji->uuid) }}" class="d-inline" method="post">
                            @csrf
                            <button class="btn btn-sm btn-info mb-3">Update Lembur</button>
                        </form>
                        <div class="table-responsive">
                            <table class="table nowrap table-bordered table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>Tanggal</th>
                                        <th>Durasi</th>
                                        <th>Nominal Perjam</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->durasi . ' Jam' }}</td>
                                            <td>{{ formatRupiah($item->nominal_perjam) }}</td>
                                            <td>{{ formatRupiah($item->total) }}</td>
                                            <td>
                                                <a href="{{ route('gaji-lembur.edit', $item->uuid) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="" method="post" class="d-inline" id="formDelete">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-action="{{ route('gaji-lembur.destroy', $item->uuid) }}"
                                                        class="btn btn-sm btn-danger btnDelete"><i class="fas fa-trash"></i>
                                                        Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function() {
            $('#dTable').DataTable();
            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah yakin?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let action = $(this).data('action');
                        $('#formDelete').attr('action', action);
                        $('#formDelete').submit();
                    }
                })
            })
        })
    </script>
    @include('layouts.partials.sweetalert')
@endpush
