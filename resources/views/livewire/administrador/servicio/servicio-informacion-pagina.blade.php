<div>
    <!--SEO-->
    @section('tituloPagina', 'Servicio - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Información servicio</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.servicio.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>
    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">
        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos</h3>
            </div>
            <div>
                <p><strong>Nombre: </strong>{{ $servicio->nombre }}</p>
                <p><strong>Precio: </strong> S/. {{ number_format($servicio->precio_venta, 2, '.', ',') }}</p>
                <p><strong>Puntos a ganar: </strong>{{ $servicio->puntos_ganar }}</p>
                <p><strong>Puntos para canjear: </strong>{{ $servicio->puntos_canjeo }}</p>
                <p><strong>Descripción: </strong>{{ $servicio->descripcion }}</p>
            </div>
        </div>

    </div>

</div>
