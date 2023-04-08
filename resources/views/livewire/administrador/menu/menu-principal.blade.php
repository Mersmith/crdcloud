<header class="contenedor_navbar" x-data="sidebar" x-on:click.away="cerrarSidebar()"
    @resize.window="abiertoSidebar = false > 900">

    <nav class="navbar">
        <!-- HAMBURGUESA -->
        <div x-on:click="toggleSidebar" class="contenedor_hamburguesa">
            <i class="fa-solid fa-bars" style="color: #666666;"></i>
        </div>
        <!-- LOGO -->
        <div class="contenedor_logo">
            <a href="" style="width: 100%; display: flex;
            justify-content: center;">
                <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
            </a>
        </div>
        <!-- MENU -->
        <div class="contenedor_menu_link">
            <div class="sidebar_logo">
                <a href="" style="width: 100%; display: flex;
                justify-content: center;">
                    <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                </a>
                <i x-on:click="cerrarSidebar" style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
            </div>
            <hr>
            <div class="contenedor_administrador_sidebar">

                @if ($usuario->imagenPerfil)
                    <img src="{{ Storage::url($usuario->imagenPerfil->imagen_perfil_ruta) }}" />
                @else
                    <img src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}">
                @endif

                @if ($unreadCount > 0)
                    <span  style="color: #5ad7f7;"><i class="fa-solid fa-bell"></i>{{ $unreadCount }}</span>
                @endif

                <p>{{ $usuario->nombre }}</p>

                @can('rol', 'administrador')
                    <h2>administrador</h2>
                @endcan

                @can('rol', 'encargado')
                    <h2>encargado</h2>
                @endcan

                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Cerrar') }}
                    </a>
                </form>
            </div>
            <hr>
            @include('administrador.menu.menu-principal-contenedor')
            <hr>
            <!-- FIN MENU-PRINCIPAL -->
        </div>
        <!-- ICONOS -->
        <div class="contenedor_iconos">
            <i class="fa-solid fa-heart" style="color: #ffa03d;"></i>
        </div>
    </nav>

</header>

@push('script')
    <script>
        window.addEventListener("resize", function(event) {
            if (document.body.clientWidth < 900) {
                document.querySelector(".contenedor_menu_link").style.left = "-100%";

            } else {
                document.querySelector(".contenedor_menu_link").style.left = "0";
            }
        })

        function sidebar() {
            return {
                seleccionado: null,
                seleccionar(id) {
                    if (this.seleccionado == id) {
                        this.seleccionado = null;
                    } else {
                        this.seleccionado = id;
                    }
                },
                abiertoSidebar: false,
                toggleSidebar() {
                    this.abiertoSidebar = !this.abiertoSidebar
                    if (this.abiertoSidebar) {
                        document.querySelector(".contenedor_menu_link").style.left = "0";
                    } else {
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    }
                },
                /*abrirSidebar() {
                    if (this.abiertoSidebar) {
                        this.abiertoSidebar = false;
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    } else {
                        this.abiertoSidebar = true;
                        document.querySelector(".contenedor_menu_link").style.left = "0";
                    }
                },*/
                cerrarSidebar() {
                    let anchoPantalla = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                    if (anchoPantalla < 900) {
                        this.abiertoSidebar = false;
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    }
                }
            }
        }

        function subMenu1() {
            return {
                seleccionadoSubMenu1: null,
                seleccionarSubMenu1(id) {
                    if (this.seleccionadoSubMenu1 == id) {
                        this.seleccionadoSubMenu1 = null;
                    } else {
                        this.seleccionadoSubMenu1 = id;
                    }
                },
            }
        }

        function subMenu2() {
            return {
                seleccionadoSubMenu2: null,
                seleccionarSubMenu2(id) {
                    if (this.seleccionadoSubMenu2 == id) {
                        this.seleccionadoSubMenu2 = null;
                    } else {
                        this.seleccionadoSubMenu2 = id;
                    }
                },
            }
        }

        function subMenu3() {
            return {
                seleccionadoSubMenu3: null,
                seleccionarSubMenu3(id) {
                    if (this.seleccionadoSubMenu3 == id) {
                        this.seleccionadoSubMenu3 = null;
                    } else {
                        this.seleccionadoSubMenu3 = id;
                    }
                },
            }
        }

        function subMenu4() {
            return {
                seleccionadoSubMenu4: null,
                seleccionarSubMenu4(id) {
                    if (this.seleccionadoSubMenu4 == id) {
                        this.seleccionadoSubMenu4 = null;
                    } else {
                        this.seleccionadoSubMenu4 = id;
                    }
                },
            }
        }
    </script>
@endpush
