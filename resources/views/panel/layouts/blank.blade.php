<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('panel.parts.head')
        @livewireStyles
    </head>

    <body class="text-sm layout-fixed layout-navbar-fixed sidebar-collapse">
        <div id="app">
            <!-- Site wrapper -->
            @include('panel.parts.navbar')

            @include('panel.parts.content')

            @include('panel.parts.footer')
            <!-- ./wrapper -->
        </div>
        @include('panel.parts.scripts')
        @livewireScripts
    </body>

</html>
