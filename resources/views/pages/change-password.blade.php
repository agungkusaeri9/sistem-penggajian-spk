@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Ubah Password</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body px-1">
                        <form method="post" class="needs-validation" action="{{ route('change-password.update') }}"
                            novalidate="">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Password Saat Ini</label>
                                    <input type="password"
                                        class="form-control @error('current_password') is-invalid @enderror" required=""
                                        name="current_password">
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        required="" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        required="" name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class=" text-right">
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    @include('layouts.partials.sweetalert')
@endpush
