@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Detail Gaji</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <td>{{ $gaji->karyawan->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $gaji->karyawan->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Bulan</th>
                                    <td>{{ getMonthName($gaji->bulan) }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>{{ $gaji->tahun }}</td>
                                </tr>
                                <tr>
                                    <th>Tipe Pembayaran</th>
                                    <td>{{ $gaji->tipe_pembayaran }}</td>
                                </tr>
                                @if ($gaji->tipe_pembayaran === 'transfer')
                                    <tr>
                                        <th>Bank</th>
                                        <td>{{ $gaji->bank->getFull() }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Status</th>
                                    <td>{!! $gaji->status() !!}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Gaji Pokok</th>
                                    <td>{{ formatRupiah($gaji->gaji_pokok) }}</td>
                                </tr>
                                <tr>
                                    <th>Lembur</th>
                                    <td>{{ formatRupiah($gaji->gaji_lembur) }}</td>
                                </tr>
                                <tr>
                                    <th>Tunjangan</th>
                                    <td>{{ formatRupiah($gaji->tunjangan) }}</td>
                                </tr>
                                <tr>
                                    <th>Potongan</th>
                                    <td>{{ formatRupiah($gaji->potongan) }}</td>
                                </tr>
                                <tr>
                                    <th>Gaji Bersih</th>
                                    <td>{{ formatRupiah($gaji->gaji_bersih) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Detail Tunjangan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table nowrap table-bordered table-hover dTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>Tunjangan</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gaji->karyawan->golongan_gaji->tunjangans as $tunjangan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $tunjangan->tunjangan->nama }}</td>
                                            <td>{{ formatRupiah($tunjangan->nominal) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Detail Lembur</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table nowrap table-bordered table-hover dTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>Tanggal</th>
                                        <th>Durasi (Jam)</th>
                                        <th>Nominal /Jam</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gaji->lembur as $lembur)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ formatTanggal($lembur->tanggal) }}</td>
                                            <td>{{ $lembur->durasi }}</td>
                                            <td>{{ formatRupiah($lembur->nominal_perjam) }}</td>
                                            <td>{{ formatRupiah($lembur->total) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Detail Potongan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table nowrap table-bordered table-hover dTable">
                                <thead>
                                    <tr>
                                        <th width="10">No.</th>
                                        <th>Potongan</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gaji->potongans as $potongan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $potongan->nama }}</td>
                                            <td>{{ formatRupiah($potongan->nominal) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
            $('.dTable').DataTable();
        })
    </script>
    @include('layouts.partials.sweetalert')
@endpush
