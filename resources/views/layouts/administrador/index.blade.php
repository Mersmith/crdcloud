<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!--META TAGS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('descripcion')">

    <!--TITULO-->
    <title>{{ env('APP_NAME') }} | @yield('tituloPagina')</title>

    <!--SCRIPTS-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!--STYLES-->
    @livewireStyles
    @include('layouts.administrador.componentes.css')

</head>

<body class="font-sans antialiased">

    <div class="min-h-screen">

        <!--MENU PRINCIPAL ADMINISTRADOR-->
        @livewire('administrador.menu.menu-principal')

        <!--MAIN PÁGINA-->
        <main class="contenedor_layout_administrador">

            @if (session('crear'))
                <div id="mensaje_alerta_crear" class="mensaje_alerta">
                    <p>{{ session('crear') }}</p>
                    <i class="fa-solid fa-circle-check"></i>
                    <script>
                        window.onload = function() {
                            mensajeCreado();
                        };
                    </script>
                </div>
            @endif
            @if (session('editar'))
                <div id="mensaje_alerta_editar" class="mensaje_alerta">
                    <p>{{ session('editar') }}</p>
                    <i class="fa-solid fa-circle-check"></i>
                    <script>
                        window.onload = function() {
                            mensajeActualizado();
                        };
                    </script>
                </div>
            @endif
            @if (session('eliminar'))
                <div class="mensaje_alerta">
                    <p>{{ session('eliminar') }}</p>
                    <i class="fa-solid fa-circle-check"></i>
                    <script>
                        window.onload = function() {
                            mensajeEliminado();
                        };
                    </script>
                </div>
            @endif
            @if (session('error'))
                <div class="mensaje_alerta">
                    <p>{{ session('error') }}</p>
                    <i class="fa-solid fa-circle-check"></i>
                    <script>
                        window.onload = function() {
                            mensajeError();
                        };
                    </script>
                </div>
            @endif

            <!--CONTENENIDO DE PÁGINAS-->
            {{ $slot }}

            <!--BOTONES SCROLL-->
            <button onClick="window.scrollTo(0, 0);" class="contenedor_boton_scroll_top">
                <i class="fa-solid fa-arrow-up"></i>
            </button>

            <button onClick="window.scrollTo(0, document.body.scrollHeight);" class="contenedor_boton_scroll_abajo">
                <i class="fa-solid fa-arrow-down"></i>
            </button>

        </main>

    </div>

    <!--SCRIPTS-->
    @include('layouts.administrador.componentes.js')
    @stack('modals')
    @livewireScripts
    @stack('script')
    <script>
        Livewire.on('mensajeCreado', mensaje => {
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
        })

        function mensajeActualizado() {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: "Actualizado",
                showConfirmButton: false,
                timer: 2500
            })
        }

        function mensajeCreado() {
            event.preventDefault();
            Swal.fire({
                icon: 'success',
                title: "Creado correctamente",
                showConfirmButton: false,
                timer: 2500
            })
        }

        function mensajeEliminado() {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: "Eliminado correctamente",
                showConfirmButton: false,
                timer: 2500
            })
        }

        function mensajeError() {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: '¡Alto!',
                text: "Rebice bien.",
                showConfirmButton: false,
                timer: 2500
            })
        }
    </script>

</body>

</html>
