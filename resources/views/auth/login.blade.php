@extends('auth.app')
@section('title')
    Login | Admin
@endsection
@section('content')
    <div class="container d-flex align-items-center" style="min-height: 100vh;">
        <!-- Outer Row -->
        <div class="row justify-content-center w-100">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login System!</h1>
                                    </div>
                                    <form class="user" method="post" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control @error('email')is-invalid @enderror form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." value="{{ old('email') }}"
                                                name="email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                class="form-control  @error('password')is-invalid @enderror form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck"
                                                    name="remember">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>

                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
