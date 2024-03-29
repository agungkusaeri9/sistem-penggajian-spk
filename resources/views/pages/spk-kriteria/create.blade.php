@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tambah SPK Kriteria</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('spk-kriteria.store') }}" method="post" class="needs-validation" novalidate=""
                            enctype="multipart/form-data">
                            @csrf
                            <div class='form-group mb-3'>
                                <label for='kode' class='mb-2'>Kode</label>
                                <input type='text' name='kode' id='kode'
                                    class='form-control @error('kode') is-invalid @enderror' value='{{ old('kode') }}'>
                                @error('kode')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    required="" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='jenis'>Jenis</label>
                                <select name='jenis' id='jenis'
                                    class='form-control @error('jenis') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih jenis</option>
                                    <option value="benefit">Benefit</option>
                                    <option value="cost">Cost</option>
                                </select>
                                @error('jenis')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='bobot' class='mb-2'>Bobot</label>
                                <input type='text' name='bobot' id='bobot'
                                    class='form-control @error('bobot') is-invalid @enderror' value='{{ old('bobot') }}'>
                                @error('bobot')
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
