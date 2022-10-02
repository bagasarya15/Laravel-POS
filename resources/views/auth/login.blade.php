<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lara-Pos | Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/extensions/toastr/toastr.css') }}"> --}}
    {{-- <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon"> --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/icon.png') }}" type="image/png">
</head>

@include('layouts.sweet-alert')
<body class="bg-primary">
    <div class="container col-lg-4">
        <div class="row" style="margin-top:170px;">
            <div class="col-lg-12 col-lg-8">
                <div class="card shadow-lg rounded">
                    <h1 class="text-center my-3">Login.</h1>
                    <form action="{{ route('login.post') }}" method="POST" class="form form-horizontal">
                        @csrf
                        <div class="row mx-2">
                            <div class="col-md-8 col-md-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" name="username" class="form-control form-control-xl" placeholder="Username" autocomplete="off" value="{{ old('username') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <input  type="password" id="password-login" name="password" class="form-control form-control-xl" placeholder="Password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="check-login-pass" class="form-check-input form-check-primary">
                                    <label class="form-check-label">Lihat Password</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-xs shadow-lg mt-3">Log in</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center mt-4 text-lg-12 text-lg-8 fs-6">
                        <p class="text-gray-600 fs-6">Belum Punya Akun ? <a href="#" class="font-bold">Daftar Sekarang !</a></p>
                        {{-- <p><a class="font-bold fs-6" href="#">Lupa Password</a></p> --}}
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
{{-- <script src="{{ asset('assets/extensions/toastr/toastr.min.js') }}"></script> --}}
</html>
