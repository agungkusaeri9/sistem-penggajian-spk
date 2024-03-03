@extends('layouts.app')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Data Gaji</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if (is_admin())
                            <a href="{{ route('gaji.create') }}" class="btn btn-sm btn-primary mb-3">Tambah
                                Data</a>
                        @endif
                        <div class="table-responsive">
                            <table class="table nowrap table-bordered table-hover" id="dTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>Nama Karyawan</th>
                                        <th>NIK</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Pokok</th>
                                        <th>Lembur</th>
                                        <th>Tunjangan</th>
                                        <th>Potongan</th>
                                        <th>Bersih</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->karyawan->nama }}</td>
                                            <td>{{ $item->karyawan->nik }}</td>
                                            <td>{{ getMonthName($item->bulan) }}</td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>{{ formatRupiah($item->gaji_pokok) }}</td>
                                            <td>{{ formatRupiah($item->gaji_lembur) }}</td>
                                            <td>{{ formatRupiah($item->tunjangan) }}</td>
                                            <td>{{ formatRupiah($item->potongan) }}</td>
                                            <td>{{ formatRupiah($item->gaji_bersih) }}</td>
                                            <td>{!! $item->status() !!}</td>
                                            <td>
                                                <a href="{{ route('gaji.detail', $item->uuid) }}"
                                                    class="btn btn-sm btn-warning"> Detail</a>
                                                @if (is_admin())
                                                    <a href="{{ route('gaji-lembur.index', $item->uuid) }}"
                                                        class="btn btn-sm btn-secondary"> Lembur</a>
                                                    <a href="{{ route('gaji-potongan.index', $item->uuid) }}"
                                                        class="btn btn-sm btn-warning"> Potongan</a>
                                                    <a href="{{ route('gaji.edit', $item->uuid) }}"
                                                        class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                    <form action="" method="post" class="d-inline" id="formDelete">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-action="{{ route('gaji.destroy', $item->uuid) }}"
                                                            class="btn btn-sm btn-danger btnDelete"><i
                                                                class="fas fa-trash"></i>
                                                            Hapus</button>
                                                    </form>
                                                @endif
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
