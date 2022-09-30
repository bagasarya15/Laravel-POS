<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
    </head>

    <body>
        <div id="app">
            <div id="sidebar" class="active">
                @include('layouts.sidebar')
            </div>
            <div id="main">
                <header class="mb-3">
                    @include('layouts.header')
                </header>

                <div class="page-heading">
                    @include('layouts.heading')
                </div>
                
                <div class="page-content">
                    @yield('content')
                </div>

                <footer>
                    @include('layouts.footer')
                </footer>
            </div>
        </div>
        @include('layouts.script')
    </body>
</html>
