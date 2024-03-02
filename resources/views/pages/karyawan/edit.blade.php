@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Karyawan</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('karyawan.update', $item->id) }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    required="" name="nama" value="{{ $item->nama ?? old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nik' class='mb-2'>NIK</label>
                                <input type='text' name='nik' class='form-control @error('nik') is-invalid @enderror'
                                    value='{{ $item->nik ?? old('nik') }}'>
                                @error('nik')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nomor_ktp' class='mb-2'>Nomor KTP</label>
                                <input type='text' name='nomor_ktp' id='nomor_ktp'
                                    class='form-control @error('nomor_ktp') is-invalid @enderror'
                                    value='{{ $item->nomor_ktp ?? old('nomor_ktp') }}'>
                                @error('nomor_ktp')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='jenis_kelamin'>Jenis Kelamin</label>
                                <select name='jenis_kelamin' id='jenis_kelamin'
                                    class='form-control @error('jenis_kelamin') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Jenis Kelamin</option>
                                    <option @selected($item->jenis_kelamin === 'Laki-laki') value="Laki-laki">Laki-laki</option>
                                    <option @selected($item->jenis_kelamin === 'Perempuan') value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='tempat_lahir' class='mb-2'>Tempat Lahir</label>
                                <input type='text' name='tempat_lahir'
                                    class='form-control @error('tempat_lahir') is-invalid @enderror'
                                    value='{{ $item->tempat_lahir ?? old('tempat_lahir') }}'>
                                @error('tempat_lahir')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='tanggal_lahir' class='mb-2'>Tanggal Lahir</label>
                                <input type='date' name='tanggal_lahir'
                                    class='form-control @error('tanggal_lahir') is-invalid @enderror'
                                    value='{{ $item->tanggal_lahir ?? old('tanggal_lahir') }}'>
                                @error('tanggal_lahir')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='alamat' class='mb-2'>Alamat</label>
                                <textarea name='alamat' id='alamat' cols='30' rows='3'
                                    class='form-control @error('alamat') is-invalid @enderror'>{{ $item->alamat ?? old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='jabatan_id'>Jabatan</label>
                                <select name='jabatan_id' id='jabatan_id'
                                    class='form-control @error('jabatan_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih jabatan</option>
                                    @foreach ($data_jabatan as $jabatan)
                                        <option @selected($jabatan->id == $item->jabatan_id) value='{{ $jabatan->id }}'>
                                            {{ $jabatan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='divisi_id'>Divisi</label>
                                <select name='divisi_id' id='divisi_id'
                                    class='form-control @error('divisi_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Divisi</option>
                                    @foreach ($data_divisi as $divisi)
                                        <option @selected($divisi->id == $item->divisi_id) value='{{ $divisi->id }}'>
                                            {{ $divisi->nama }}</option>
                                    @endforeach
                                </select>
                                @error('divisi_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='golongan_gaji_id'>Golongan Gaji</label>
                                <select name='golongan_gaji_id' id='golongan_gaji_id'
                                    class='form-control @error('golongan_gaji_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Golongan Gaji</option>
                                </select>
                                @error('golongan_gaji_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='gaji_pokok' class='mb-2'>Gaji Pokok</label>
                                <input type='text' id="gaji_pokok"
                                    class='form-control @error('gaji_pokok') is-invalid @enderror' readonly>
                                @error('gaji_pokok')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nomor_telepon' class='mb-2'>Nomor Telepon</label>
                                <input type='text' name='nomor_telepon' id='nomor_telepon'
                                    class='form-control @error('nomor_telepon') is-invalid @enderror'
                                    value='{{ $item->nomor_telepon ?? old('nomor_telepon') }}'>
                                @error('nomor_telepon')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='email' class='mb-2'>Email</label>
                                <input type='text' name='email' id='email'
                                    class='form-control @error('email') is-invalid @enderror'
                                    value='{{ $item->user->email ?? old('email') }}'>
                                @error('email')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='password' class='mb-2'>Password</label>
                                <input type='password' name='password' id='password'
                                    class='form-control @error('password') is-invalid @enderror'
                                    value='{{ old('password') }}'>
                                @error('password')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='password_confirmation' class='mb-2'>Konfirmasi Password</label>
                                <input type='password' name='password_confirmation' id='password_confirmation'
                                    class='form-control @error('password_confirmation') is-invalid @enderror'
                                    value='{{ old('password_confirmation') }}'>
                                @error('password_confirmation')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='status_karyawan'>Status Karyawan</label>
                                <select name='status_karyawan' id='status_karyawan'
                                    class='form-control @error('status_karyawan') is-invalid @enderror'>
                                    <option value=''>Pilih Status Karyawan</option>
                                    <option @selected($item->status_karyawan == 1) value="1">Aktif</option>
                                    <option @selected($item->status_karyawan == 2) value="2">Cuti</option>
                                    <option @selected($item->status_karyawan == 3) value="3">Resign</option>
                                    <option @selected($item->status_karyawan == 4) value="4">Kontrak</option>
                                    <option @selected($item->status_karyawan == 5) value="5">Tidak Aktif
                                    </option>
                                </select>
                                @error('status_karyawan')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='tanggal_bergabung' class='mb-2'>Tanggal Bergabung</label>
                                <input type='date' name='tanggal_bergabung' id='tanggal_bergabung'
                                    class='form-control @error('tanggal_bergabung') is-invalid @enderror'
                                    value='{{ $item->tanggal_bergabung ?? old('tanggal_bergabung') }}'>
                                @error('tanggal_bergabung')
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

            // load

            let jabatan_id = '{{ $item->jabatan_id }}';
            let golongan_gaji_id = '{{ $item->golongan_gaji_id }}';
            $.ajax({
                url: '{{ route('golongan-gaji.getByJabatanId', ':id') }}'.replace(':id',
                    jabatan_id),
                dataType: 'JSON',
                data: 'GET',
                success: function(res) {
                    let data_golongan_gaji = res.data;
                    $('#golongan_gaji_id').empty();
                    $('#golongan_gaji_id').append(
                        `<option selected>Pilih Golongan Gaji</option>`
                    );
                    data_golongan_gaji.forEach(golongan_gaji => {
                        if (golongan_gaji.id == golongan_gaji_id) {
                            $('#gaji_pokok').val(formatRupiah(golongan_gaji.gaji_pokok));
                            $('#golongan_gaji_id').append(
                                `<option selected value="${golongan_gaji.id}">${golongan_gaji.kode}</option>`
                            );
                        } else {
                            $('#golongan_gaji_id').append(
                                `<option value="${golongan_gaji.id}">${golongan_gaji.kode}</option>`
                            );
                        }
                    });
                }
            })

            function formatRupiah(angka) {
                // Pertama, buang bagian desimal jika ada dan pastikan input adalah angka bulat
                var number_string = parseInt(angka).toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                // Tambahkan titik jika yang diinputkan sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return 'Rp' + rupiah;
            }


            // get golongan gaji
            $('#jabatan_id').on('change', function() {
                let jabatan_id = $(this).val();
                $.ajax({
                    url: '{{ route('golongan-gaji.getByJabatanId', ':id') }}'.replace(':id',
                        jabatan_id),
                    dataType: 'JSON',
                    data: 'GET',
                    success: function(res) {
                        let data_golongan_gaji = res.data;
                        $('#golongan_gaji_id').empty();
                        $('#golongan_gaji_id').append(
                            `<option selected>Pilih Golongan Gaji</option>`
                        );
                        data_golongan_gaji.forEach(golongan_gaji => {
                            $('#golongan_gaji_id').append(
                                `<option value="${golongan_gaji.id}">${golongan_gaji.kode}</option>`
                            );
                        });
                    }
                })
            })
            // get golongan gaji detail
            $('#golongan_gaji_id').on('change', function() {
                let golongan_gaji_id = $(this).val();
                let jabatan_id = $('#jabatan_id').val();
                $.ajax({
                    url: '{{ route('golongan-gaji.show', ':id') }}'.replace(':id',
                        golongan_gaji_id),
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        jabatan_id: jabatan_id
                    },
                    success: function(res) {
                        $('#gaji_pokok').val(formatRupiah(res.data.gaji_pokok));
                    }
                })
            })
        })
    </script>
@endpush
