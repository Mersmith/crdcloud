<x-web-layout>
    <!--SEO-->
    @section('tituloPagina', 'Inicio')

    <!--CONTENIDO PÁGINA-->

    <!--SLIDER PRINCIPAL-->
    @include('web.inicio.slider-principal')

    <!--QUÉ ES CRD CLOUD-->
    @include('web.inicio.informacion')

    <!--CÓMO REGISTRARSE A CRD CLOUD-->
    @include('web.inicio.registrarse')

    <!--SERVICIOS-->
    @include('web.inicio.servicios')

    <!--SLIDER ENCARGADOS-->
    @include('web.inicio.slider-encargados')

    <!--SEDES-->
    @include('web.inicio.sedes')

    <!--BENEFICIOS-->
    @include('web.inicio.beneficios')

    <!--CONTACTO-->
    @include('web.inicio.contacto')
</x-web-layout>
