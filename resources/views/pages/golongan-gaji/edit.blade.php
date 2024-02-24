@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Golongan Gaji</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('golongan-gaji.update', $item->id) }}" method="post" class="needs-validation"
                            novalidate="">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                    required="" name="kode" value="{{ $item->kode ?? old('kode') }}">
                                @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='deskripsi' class='mb-2'>Deskripsi</label>
                                <textarea name='deskripsi' id='deskripsi' cols='30' rows='3'
                                    class='form-control @error('deskripsi') is-invalid @enderror'>{{ $item->deskripsi ?? old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='tingkat' class='mb-2'>Tingkat</label>
                                <input type='text' name='tingkat'
                                    class='form-control @error('tingkat') is-invalid @enderror'
                                    value='{{ $item->tingkat ?? old('tingkat') }}'>
                                @error('tingkat')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group'>
                                <label for='jabatan_id'>Jabatan</label>
                                <select name='jabatan_id' id='jabatan_id'
                                    class='form-control @error('jabatan_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Jabatan</option>
                                    @foreach ($data_jabatan as $jabatan)
                                        <option @selected($jabatan->id == $item->jabatan_id) value='{{ $jabatan->id }}'>
                                            {{ $jabatan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='gaji_pokok' class='mb-2'>Gaji Pokok</label>
                                <input type='number' name='gaji_pokok'
                                    class='form-control @error('gaji_pokok') is-invalid @enderror'
                                    value='{{ $item->gaji_pokok ?? old('gaji_pokok') }}'>
                                @error('gaji_pokok')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='catatan' class='mb-2'>Catatan</label>
                                <textarea name='catatan' id='catatan' cols='30' rows='3'
                                    class='form-control @error('catatan') is-invalid @enderror'>{{ $item->catatan ?? old('catatan') }}</textarea>
                                @error('catatan')
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
