@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Gaji Potongan</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('gaji-potongan.update', $item->uuid) }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class='form-group mb-3'>
                                <label for='nama' class='mb-2'>Nama</label>
                                <input type='text' name='nama' id='nama'
                                    class='form-control @error('nama') is-invalid @enderror'
                                    value='{{ $item->nama ?? old('nama') }}'>
                                @error('nama')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class='form-group mb-3'>
                                <label for='nominal' class='mb-2'>Nominal</label>
                                <input type='number' name='nominal' id='nominal'
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
