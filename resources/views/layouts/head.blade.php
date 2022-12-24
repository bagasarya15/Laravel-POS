        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $store_information->name }} | @yield('title')</title>
        
        {{-- Use Path Folder --}}
        <link rel="stylesheet"  href="{{ asset('assets/extensions/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}" />
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/icon.png') }} "type="image/png" />
        <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">

        <link href="{{ asset('assets/extensions/fontawesome-6/css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/extensions/fontawesome-6/css/brands.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/extensions/fontawesome-6/css/solid.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/css/pages/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}" />
        {{-- End --}}