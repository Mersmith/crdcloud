<!--CENTRAR ELEMENTOS-->
<div class="centrar_elementos" id="seccion_equipo">
    <div class="contenedor_slider_encargados">
        <!--TÍTULO-->
        <div class="titulo_servicios">
            <h2>Nuestro equipo</h2>
        </div>
        <div class="gliderSliderEncargados">
            <!--SLIDER 1-->
            <div class="slider_encargado_item">
                <img src="{{ asset('imagenes/encargados/3.png') }}">
                <div class="contenedor_nombre_encargado">
                    <h4>ANDRES FLORES</h4>
                    <span>Administrador de CRD Miraflores</span>
                </div>
            </div>
            <!--SLIDER 2-->
            <div class="slider_encargado_item">
                <img src="{{ asset('imagenes/encargados/2.png') }}">
                <div class="contenedor_nombre_encargado">
                    <h4>STHEFANNY QUILLAMA</h4>
                    <span>Administradora de CRD La Molina</span>
                </div>
            </div>
            <!--SLIDER 3-->
            <div class="slider_encargado_item">
                <img src="{{ asset('imagenes/encargados/4.png') }}">
                <div class="contenedor_nombre_encargado">
                    <h4>DENNIS CHOMBO</h4>
                    <span>Administradora de CRD San Juan de Lurigancho</span>
                </div>
            </div>
            <!--SLIDER 4-->
            <div class="slider_encargado_item">
                <img src="{{ asset('imagenes/encargados/5.png') }}">
                <div class="contenedor_nombre_encargado">
                    <h4>DANYELE SOTO</h4>
                    <span>Administradora de CRD Los Olivos</span>
                </div>
            </div>
            <!--SLIDER 5-->
            <div class="slider_encargado_item">
                <img src="{{ asset('imagenes/encargados/1.png') }}">
                <div class="contenedor_nombre_encargado">
                    <h4>JANUARY CEDEÑO</h4>
                    <span>Administradora de CRD San Isidro</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    gliderAutoplay(
        new Glider(document.querySelector('.gliderSliderEncargados'), {
            slidesToShow: 3,
            slidesToScroll: 3,
            draggable: true,
            responsive: [{
                breakpoint: 300,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 640,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }, {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            }]
        }), {
            interval: 5000,
        }
    );
</script>
