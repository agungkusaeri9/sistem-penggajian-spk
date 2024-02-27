@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tambah Tunjungan Golongan Gaji : {{ $item->kode }}</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('golongan-gaji-tunjangan.store', $item->id) }}" method="post"
                            class="needs-validation" novalidate="">
                            @csrf
                            <div class='form-group'>
                                <label for='tunjangan_id'>Tunjangan</label>
                                <select name='tunjangan_id' id='tunjangan_id'
                                    class='form-control @error('tunjangan_id') is-invalid @enderror'>
                                    <option value='' selected disabled>Pilih Tunjangan</option>
                                    @foreach ($data_tunjangan as $tunjangan)
                                        <option @selected($tunjangan->id == old('tunjangan_id')) value='{{ $tunjangan->id }}'>
                                            {{ $tunjangan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tunjangan_id')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nominal' class='mb-2'>Nominal</label>
                                <input type='text' name='nominal'
                                    class='form-control @error('nominal') is-invalid @enderror'
                                    value='{{ old('nominal') }}'>
                                @error('nominal')
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
