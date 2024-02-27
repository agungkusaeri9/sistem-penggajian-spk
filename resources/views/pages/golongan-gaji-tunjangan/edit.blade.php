@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Tunjungan Golongan Gaji</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('golongan-gaji-tunjangan.update', $item->id) }}" method="post"
                            class="needs-validation" novalidate="">
                            @csrf
                            @method('patch')
                            <div class='form-group mb-3'>
                                <label for='tunjangan' class='mb-2'>Tunjangan</label>
                                <input type='text' name='tunjangan'
                                    class='form-control @error('tunjangan') is-invalid @enderror'
                                    value='{{ $item->tunjangan->nama ?? old('tunjangan') }}' readonly>
                                @error('tunjangan')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nominal' class='mb-2'>Nominal</label>
                                <input type='text' name='nominal'
                                    class='form-control @error('nominal') is-invalid @enderror'
                                    value='{{ $item->nominal ?? old('nominal') }}'>
                                @error('nominal')
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
