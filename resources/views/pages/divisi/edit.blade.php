@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit Divisi</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('divisi.update', $item->id) }}" method="post" class="needs-validation"
                            novalidate="">
                            @csrf
                            @method('patch')
                            <div class='form-group mb-3'>
                                <label for='nama' class='mb-2'>Nama</label>
                                <input type='text' name='nama'
                                    class='form-control @error('nama') is-invalid @enderror'
                                    value='{{ $item->nama ?? old('nama') }}'>
                                @error('nama')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn float-right btn-primary">Simpan</button>
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
