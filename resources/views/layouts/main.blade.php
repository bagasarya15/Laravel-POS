<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
        @livewireStyles
    </head>

    <body>
        <div id="app">
            <div id="sidebar" class="active">
                @include('layouts.sidebar')
            </div>
            <div id="main" class="layout-navbar">
                <header class="mb-3">
                    @include('layouts.header')
                </header>

                <div id="main-content">
                    @include('layouts.main-content')
                </div>

                <footer>
                    @include('layouts.footer')
                </footer>
            </div>
        </div>
        @livewireScripts
        @include('layouts.script')
        @stack('script')
    </body>
</html>
