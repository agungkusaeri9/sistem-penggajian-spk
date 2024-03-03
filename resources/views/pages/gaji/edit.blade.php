@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Gaji</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('gaji.update', $item->uuid) }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class='form-group mb-3'>
                                <label for='karyawan' class='mb-2'>karyawan</label>
                                <input type='text' name='karyawan' id='karyawan'
                                    class='form-control @error('karyawan') is-invalid @enderror'
                                    value='{{ $item->karyawan->nama . ' - ' . $item->karyawan->nik }}' readonly>
                                @error('karyawan')
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
                                    <option @selected($item->bulan == 1) value="1">Januari</option>
                                    <option @selected($item->bulan == 2) value="2">Februari</option>
                                    <option @selected($item->bulan == 3) value="3">Maret</option>
                                    <option @selected($item->bulan == 4) value="4">April</option>
                                    <option @selected($item->bulan == 5) value="5">Mei</option>
                                    <option @selected($item->bulan == 6) value="6">Juni</option>
                                    <option @selected($item->bulan == 7) value="7">Juli</option>
                                    <option @selected($item->bulan == 8) value="8">Agustus</option>
                                    <option @selected($item->bulan == 9) value="9">September</option>
                                    <option @selected($item->bulan == 10) value="10">Oktober</option>
                                    <option @selected($item->bulan == 11) value="11">November</option>
                                    <option @selected($item->bulan == 12) value="12">Desember</option>
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
                                    <option @selected($item->tahun == 2024) value="2024">2024</option>
                                    <option @selected($item->tahun == 2025) value="2025">2025</option>
                                    <option @selected($item->tahun == 2026) value="2026">2026</option>
                                    <option @selected($item->tahun == 2027) value="2027">2027</option>
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
                                    <option @selected($item->tipe_pembayaran === 'transfer') value="transfer">Transfer</option>
                                    <option @selected($item->tipe_pembayaran === 'tunai') value="tunai">Tunai</option>
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
                                    class='form-control @error('keterangan') is-invalid @enderror'>{{ $item->keterangan ?? old('keterangan') }}</textarea>
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
                                    <option @selected($item->status == 0) value="0">Menunggu</option>
                                    <option @selected($item->status == 1) value="1">Diproses</option>
                                    <option @selected($item->status == 2) value="2">Diverifikasi</option>
                                    <option @selected($item->status == 3) value="3">Dibayar</option>
                                    <option @selected($item->status == 4) value="4">Gagal</option>
                                    <option @selected($item->status == 5) value="5">Ditahan</option>
                                    <option @selected($item->status == 6) value="6">Dibatalkan</option>
                                    <option @selected($item->status == 7) value="7">Dkembalikan</option>
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
                                <button class="btn float-right btn-primary">Update Data</button>
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
@push('scripts')
    <script>
        $(function() {
            let tipe_pembayaran = '{{ $item->tipe_pembayaran }}';
            let karyawan_id = '{{ $item->karyawan_id }}';
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
            }
            $('#tipe_pembayaran').on('change', function() {
                let tipe_pembayaran = $(this).val();
                let karyawan_id = '{{ $item->karyawan_id }}';
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
