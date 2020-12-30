<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('panel.parts.head')
    @livewireStyles
</head>

<body class="text-sm layout-fixed layout-navbar-fixed sidebar-collapse">
    <div class="wrapper" id="app">
        @include('panel.parts.navbar')

        @include('panel.parts.sidebar')

        @include('panel.parts.content')

        @include('panel.parts.footer')

        @include('panel.parts.sidebar-right')
    </div>
    @include('panel.parts.scripts')
    @livewireScripts
</body>

</html>
