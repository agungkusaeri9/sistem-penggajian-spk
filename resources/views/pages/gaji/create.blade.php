@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tambah Gaji</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('gaji.store') }}" method="post" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class='form-group'>
                                <label for='karyawan_id'>Karyawan</label>
                                <select name='karyawan_id' id='karyawan_id'
                                    class='form-control @error('karyawan_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Karyawan</option>
                                    @foreach ($data_karyawan as $karyawan)
                                        <option @selected($karyawan->id == old('karyawan_id')) value='{{ $karyawan->id }}'>
                                            {{ $karyawan->nama . ' - ' . $karyawan->nik }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('karyawan_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='bulan'>Bulan</label>
                                <select name='bulan' id='bulan'
                                    class='form-control @error('bulan') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                                @error('bulan')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='tahun'>Tahun</label>
                                <select name='tahun' id='tahun'
                                    class='form-control @error('tahun') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Tahun</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                </select>
                                @error('tahun')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='tipe_pembayaran'>Tipe Pembayaran</label>
                                <select name='tipe_pembayaran' id='tipe_pembayaran'
                                    class='form-control @error('tipe_pembayaran') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Tipe Pembayaran</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="tunai">Tunai</option>
                                </select>
                                @error('tipe_pembayaran')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group fg-bank d-none'>
                                <label for='bank_id'>Bank</label>
                                <select name='bank_id' id='bank_id'
                                    class='form-control @error('bank_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Bank</option>
                                </select>
                                @error('bank_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='keterangan' class='mb-2'>Keterangan</label>
                                <textarea name='keterangan' id='keterangan' cols='30' rows='3'
                                    class='form-control @error('keterangan') is-invalid @enderror'>{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='status'>Status</label>
                                <select name='status' id='status'
                                    class='form-control @error('status') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Status</option>
                                    <option @selected(old('status') == 0) value="0">Menunggu</option>
                                    <option @selected(old('status') == 1) value="1">Diproses</option>
                                    <option @selected(old('status') == 2) value="2">Diverifikasi</option>
                                    <option @selected(old('status') == 3) value="3">Dibayar</option>
                                    <option @selected(old('status') == 4) value="4">Gagal</option>
                                    <option @selected(old('status') == 5) value="5">Ditahan</option>
                                    <option @selected(old('status') == 6) value="6">Dibatalkan</option>
                                    <option @selected(old('status') == 7) value="7">Dkembalikan</option>
                                </select>
                                @error('status')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <Bukti for='bukti' class='mb-2'>Bukti</label>
                                    <input type='file' name='bukti' id='bukti'
                                        class='form-control @error('bukti') is-invalid @enderror'
                                        value='{{ old('bukti') }}'>
                                    @error('bukti')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn float-right btn-primary">Tambah Data</button>
                            </div>
                        </form>
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
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
    <script script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    @include('layouts.partials.sweetalert')
    <script>
        $(function() {

            $('#tipe_pembayaran').on('change', function() {
                let tipe_pembayaran = $(this).val();
                let karyawan_id = $('#karyawan_id').val();
                if (tipe_pembayaran === 'transfer') {
                    $('.fg-bank').removeClass('d-none');

                    // get bank by karyawan
                    $.ajax({
                        url: '{{ route('bank.getbykaryawanid') }}',
                        type: 'GET',
                        dataType: 'JSON',
                        data: {
                            karyawan_id
                        },
                        success: function(response) {
                            if (response.code === 200) {
                                $('#bank_id').empty();
                                $('#bank_id').append(
                                    `<option selected disabled>Pilih Bank</option>`);
                                response.data.forEach(bank => {
                                    $('#bank_id').append(
                                        `<option value="${bank.id}">${bank.nama} - ${bank.nomor_rekening} a.n ${bank.pemilik}</option>`
                                    );
                                });
                            }
                        }
                    })
                } else {
                    $('.fg-bank').addClass('d-none');
                }
            })
        })
    </script>
@endpush
