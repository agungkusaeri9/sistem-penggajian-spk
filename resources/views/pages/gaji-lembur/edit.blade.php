@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Gaji Lembur</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('gaji-lembur.update', $item->uuid) }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    required="" name="tanggal"
                                    value="{{ formatTanggal($item->tanggal, 'Y-m-d') ?? old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='durasi' class='mb-2'>Durasi (jam)</label>
                                <input type='number' name='durasi' id='durasi'
                                    class='form-control @error('durasi') is-invalid @enderror'
                                    value='{{ $item->durasi ?? old('durasi') }}'>
                                @error('durasi')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nominal_perjam' class='mb-2'>Nominal Perjam</label>
                                <input type='number' name='nominal_perjam' id='nominal_perjam'
                                    class='form-control @error('nominal_perjam') is-invalid @enderror'
                                    value='{{ $item->nominal_perjam ?? old('nominal_perjam') }}'>
                                @error('nominal_perjam')
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
