<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $store_information->name }} | Reset-Password</title>
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
        <div class="row" style="margin-top:170px;">
            <div class="col-lg-12 col-lg-8">
                <div class="card shadow-lg rounded">
                    <h1 class="text-center my-3 fs-3">Reset Password.</h1>
                    <form action="{{ route('forget-pass.post') }}" method="POST" class="form form-horizontal">
                        @csrf
                        <div class="row mx-2">
                            <div class="col-md-8 col-md-12">
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="email" name="email" class="form-control form-control-xl " placeholder="Masukan Email Anda" autocomplete="off">
                            
                                    <div class="form-control-icon">
                                        <i class="fa-regular fa-envelope"></i>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-xs shadow-lg mb-2">Email Password Reset Link</button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-4 text-lg-12 text-lg-8 fs-6">
                        <p class="text-gray-600 small">Batal Reset Password ? <a href="{{ route('login') }}" class="font-bold">Login </a></p>
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
