<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!--TITULO-->
    <title>{{ env('APP_NAME') }} - @yield('tituloPagina')</title>

    <!--META TAGS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('descripcion')">

    <!--FACEBOOK-->
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:title" content="@yield('tituloPagina')">
    <meta property="og:description" content="@yield('descripcion')">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es">
    <meta property="og:url" content="@yield('url')">
    <meta property="og:image" content="@yield('imagen')">

    <!--TWITTER-->
    <meta name="twitter:title" content="@yield('tituloPagina')">
    <meta name="twitter:image" content="@yield('imagen')">

    <!--SCRIPTS-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!--STYLES-->
    @livewireStyles
    @include('layouts.web.componentes.css')

</head>

<body class="font-sans antialiased">

    <!--FLASH BANNER-->
    {{--<x-jet-banner />--}}

    <div class="min-h-screen">

        <!--MENU PRINCIPAL WEB-->
        @livewire('web.menu.menu-principal')

        <!--MAIN PAGINA-->
        <main>
            <!--CONTENENIDO DE PÁGINAS-->
            {{ $slot }}
        </main>

        <!--PIE DE PÁGINA-->
        @include('layouts.web.componentes.pie-pagina')

    </div>

    <!--SCRIPTS-->
    @include('layouts.web.componentes.js')
    @stack('modals')
    @livewireScripts
    @stack('script')
    <script>
        /*Livewire.on('mensajeCreado', mensaje => {
            Swal.fire({
                icon: 'success',
                title: mensaje,
                showConfirmButton: false,
                timer: 2500
            })
        })

        Livewire.on('mensajeActualizado', mensaje => {
            Swal.fire({
                icon: 'success',
                title: mensaje,
                showConfirmButton: false,
                timer: 2500
            })
        })

        Livewire.on('mensajeEliminado', mensaje => {
            Swal.fire({
                icon: 'error',
                title: mensaje,
                showConfirmButton: false,
                timer: 2500
            })
        })

        Livewire.on('mensajeError', mensaje => {
            Swal.fire({
                icon: 'error',
                title: '¡Alto!',
                text: mensaje,
                showConfirmButton: false,
                timer: 2500
            })
        })*/
    </script>

</body>

</html>
