        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $getTitle->name }} | @yield('title')</title>
        
        {{-- Using CDN --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" /> --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        {{-- End --}}


        {{-- Use Path Folder --}}
        <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/icon.png') }} "type="image/png" />

        <link href="{{ asset('assets/extensions/fontawesome-6/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/extensions/fontawesome-6/css/brands.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/extensions/fontawesome-6/css/solid.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">
        {{-- End --}}