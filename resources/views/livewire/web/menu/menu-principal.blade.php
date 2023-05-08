<header class="contenedor_navbar">
    <!-- GRID MENU -->
    <nav class="navbar" x-data="sidebar" x-on:click.away="cerrarSidebar()">
        <!-- REDES -->
        <div class="navbar_pie_redes">
            <a href="https://www.facebook.com/profile.php?id=100090626147119" target="_blank"><i
                    class="fa-brands fa-facebook" style="color: #666666;"></i></a>
            <a href="https://www.instagram.com/centroradiologicodigitalcrd/?hl=es-la" target="_blank"><i
                    class="fa-brands fa-instagram" style="color: #666666;"></i></a>
            <a href="https://www.tiktok.com/@crdcentroradiologico" target="_blank"><i class="fa-brands fa-tiktok"
                    style="color: #666666;"></i></a>
            <a href="https://www.youtube.com/@httv5294" target="_blank"><i class="fa-brands fa-youtube"
                    style="color: #666666;"></i></a>
            <a href="https://api.whatsapp.com/send/?phone=51997890934&text&type=phone_number&app_absent=0"
                target="_blank"><i class="fa-brands fa-whatsapp" style="color: #666666;"></i></a>
        </div>

        <!-- MENU -->
        <div class="contenedor_menu">
            <!-- LOGO -->
            <div class="contenedor_logo">
                <a href="{{ route('inicio') }}">
                    <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                </a>
            </div>
            <!-- LINKS -->
            <div class="contenedor_menu_link" :class="{ 'block': abiertoSidebar, 'block': !abiertoSidebar }">
                <!-- SIDEBAR LOGO -->
                <div class="sidebar_logo">
                    <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                    <i x-on:click="cerrarSidebar" style="cursor: pointer; color: #666666;"
                        class="fa-solid fa-xmark"></i>
                </div>
                @include('web.menu.menu-pie')
            </div>
            <!-- HAMBURGUESA -->
            <div x-on:click="abrirSidebar" class="contenedor_hamburguesa">
                <i class="fa-solid fa-bars" style="color: #666666;"></i>
            </div>
        </div>
    </nav>
</header>

@push('script')
    <script>
        function sidebar() {
            return {
                abiertoSidebar: false,
                toggleSidebar() {
                    this.abiertoSidebar = !this.abiertoSidebar
                },
                abrirSidebar() {
                    if (this.abiertoSidebar) {
                        this.abiertoSidebar = false;
                        document.querySelector(".contenedor_menu_link").style.left = "-100%";
                    } else {
                        this.abiertoSidebar = true;
                        document.querySelector(".contenedor_menu_link").style.left = "0";
                    }
                },
                cerrarSidebar() {
                    this.abiertoSidebar = false;
                    document.querySelector(".contenedor_menu_link").style.left = "-100%";
                }
            }
        }
    </script>
@endpush
