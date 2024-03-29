@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit SPK Kriteria</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('spk-kriteria-detail.update', $item->id) }}" method="post"
                            class="needs-validation" novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class='form-group mb-3'>
                                <label for='spk_kriteria_id' class='mb-2'>Kriteria</label>
                                <input type='text' name='' id='spk_kriteria_id'
                                    class='form-control @error('spk_kriteria_id') is-invalid @enderror'
                                    value='{{ $item->kriteria->nama ?? old('spk_kriteria_id') }}' readonly>
                                @error('spk_kriteria_id')
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
                                <label for='nilai' class='mb-2'>Nilai</label>
                                <input type='number' name='nilai' id='nilai'
                                    class='form-control @error('nilai') is-invalid @enderror'
                                    value='{{ $item->nilai ?? old('nilai') }}'>
                                @error('nilai')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn float-right btn-primary">Edit Data</button>
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
