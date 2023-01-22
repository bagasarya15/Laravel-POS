<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store_information->name }} | Register</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link href="{{ asset('assets/extensions/fontawesome-6/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/fontawesome-6/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/extensions/fontawesome-6/css/solid.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/icon.png') }}" type="image/png">
</head>

@include('layouts.sweet-alert')
<body class="bg-primary">
    <div class="container col-lg-4">
        <div class="row" style="margin-top:60px;">
            <div class="col-lg-12 col-lg-8">
                <div class="card shadow-lg rounded">
                    <h1 class="text-center my-3">Register.</h1>
                    <form action="{{ route('register.post') }}" method="POST" class="form form-horizontal">
                        @csrf
                        <div class="row mx-2">
                            <div class="col-md-8 col-md-12">
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" name="username" class="form-control form-control-xl @error('username') is-invalid  @enderror" placeholder="Username" autocomplete="off" value="{{ old('username') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    @error('username')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" name="name" class="form-control form-control-xl @error('name') is-invalid  @enderror" placeholder="Nama" autocomplete="off" value="{{ old('name') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    @error('name')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control form-control-xl @error('password') is-invalid  @enderror" name="password" id="password" placeholder="Password">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" id="check-new-pass" class="form-check-input form-check-primary">
                                        <label class="form-check-label">Lihat Password</label>
                                    </div>
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                    @error('password')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control form-control-xl @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password">
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" id="check-confirm-pass" class="form-check-input form-check-primary">
                                        <label class="form-check-label">Lihat Password</label>
                                    </div>
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                    @error('confirm_password')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <input type="hidden" name="role_id" value="3">
                                <input type="hidden" value="avatar/default.jpg" name="image">
                                <div class="d-flex">
                                    <button type="reset" class="btn btn-danger btn-block btn-xs shadow-lg mt-2 mx-1">Reset</button>
                                    <button type="submit" class="btn btn-primary btn-block btn-xs shadow-lg mt-2 mx-1">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-center mt-4 text-lg-12 text-lg-8 fs-6">
                        <p class="text-gray-600 fs-6">Sudah Punya Akun ? <a href="{{ route('login') }}" class="font-bold">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/sweetalert2.js') }}"></script>
</html>
