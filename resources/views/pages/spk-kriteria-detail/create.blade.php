@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tambah SPK Detail Kriteria</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('spk-kriteria-detail.store') }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <div class='form-group'>
                                <label for='spk_kriteria_id'>Kriteria</label>
                                <select name='spk_kriteria_id' id='spk_kriteria_id'
                                    class='form-control @error('spk_kriteria_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Kriteria</option>
                                    @foreach ($data_kriteria as $kriteria)
                                        <option @selected($kriteria->id == old('spk_kriteria_id')) value='{{ $kriteria->id }}'>
                                            {{ $kriteria->kode . ' | ' . $kriteria->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('spk_kriteria_id')
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
                            <div class='form-group mb-3'>
                                <label for='nilai' class='mb-2'>Nilai</label>
                                <input type='number' name='nilai' id='nilai'
                                    class='form-control @error('nilai') is-invalid @enderror' value='{{ old('nilai') }}'>
                                @error('nilai')
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
