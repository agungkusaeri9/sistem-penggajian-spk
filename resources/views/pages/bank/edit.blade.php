@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Bank</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('bank.update', $item->id) }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class='form-group'>
                                <label for='karyawan_id'>Karyawan</label>
                                <select name='karyawan_id' id='karyawan_id'
                                    class='form-control @error('karyawan_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Karyawan</option>
                                    @foreach ($data_karyawan as $karyawan)
                                        <option @selected($karyawan->id == $item->karyawan_id) value='{{ $karyawan->id }}'>
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
                                <label for='nomor_rekening' class='mb-2'>Nomor Rekening</label>
                                <input type='number' name='nomor_rekening' id='nomor_rekening'
                                    class='form-control @error('nomor_rekening') is-invalid @enderror'
                                    value='{{ $item->nomor_rekening ?? old('nomor_rekening') }}'>
                                @error('nomor_rekening')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='pemilik' class='mb-2'>Pemilik</label>
                                <input type='text' name='pemilik' id='pemilik'
                                    class='form-control @error('pemilik') is-invalid @enderror'
                                    value='{{ $item->pemilik ?? old('pemilik') }}'>
                                @error('pemilik')
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
