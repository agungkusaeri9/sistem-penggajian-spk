@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Edit User</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('users.update', $item->id) }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    required="" name="name" value="{{ $item->name ?? old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    required="" name="username" value="{{ $item->username ?? old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    required="" name="email" value="{{ $item->email ?? old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Password <span class="text-gray small">(Kosongkan jik tidak ingin merubah
                                            password)</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Konfirmasi Password <span class="text-gray small">(Kosongkan jik tidak
                                            ingin
                                            merubah password)</span></label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control" required="">
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option @if ($item->status == 1 ?? old('status') == 1) selected @endif value="1">Aktif
                                    </option>
                                    <option @if ($item->status == 0 ?? old('status') == 0) selected @endif value="0">Tidak
                                        Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <div class="text-center">
                                        <label>Avatar</label><br>
                                        <img src="{{ $item->avatar() }}" class="img-fluid rounded-circle"
                                            style="max-height: 80px" alt="">
                                    </div>
                                </div>
                                <div class="col-md-11 align-self-center">
                                    <input type="file" name="avatar" class="form-control">
                                    @error('avatar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
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
