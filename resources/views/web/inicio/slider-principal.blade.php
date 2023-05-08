<div class="contenedor_slider_principal">
    <div class="gliderSliderPrincipal">
        <!--SLIDER 1-->
        <div class="slider_slider_item">
            <a href="https://crdcloud.centroradiologico.com.pe/" target="_blank">
                <img src="{{ asset('imagenes/slider/slider-1.png') }}" class="slider_principal_imagen">
            </a>
        </div>
        <!--SLIDER 1-->
        <div class="slider_slider_item">
            <a>
                <img src="{{ asset('imagenes/slider/slider-2.png') }}" class="slider_principal_imagen">
            </a>
        </div>
    </div>
    <button class="slider_principal_boton gliderSliderPrincipal-prev-1">
        <i class="fa-solid fa-angle-left"></i>
    </button>
    <button class="slider_principal_boton gliderSliderPrincipal-next-1">
        <i class="fa-solid fa-angle-right"></i>
    </button>
    <div class="slider_principal_pie dots"></div>
</div>

<script>
    gliderAutoplay(
        new Glider(document.querySelector('.gliderSliderPrincipal'), {
            slidesToShow: 1,
            slidesToScroll: 1,
            draggable: true,
            dots: ".dots",
            arrows: {
                prev: '.gliderSliderPrincipal-prev-1',
                next: '.gliderSliderPrincipal-next-1'
            },
        }), {
            interval: 5000,
        }
    );
</script>
