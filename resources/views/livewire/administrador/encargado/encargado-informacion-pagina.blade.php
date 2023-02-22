<div>
    <!--SEO-->
    @section('tituloPagina', 'Encargado - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Encargado de: {{ $encargado->sede->nombre }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.encargado.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos del encargado de sede:</h3>
            </div>
            <div>
                <p><strong>Nombre: </strong>{{ $encargado->nombre }} </p>
                <p><strong>Apellido: </strong>{{ $encargado->apellido }} </p>
                <p><strong>Correo: </strong>{{ $encargado->email }} </p>
                <p><strong>DNI: </strong>{{ $usuario_encargado->dni }} </p>
                <p><strong>Sede: </strong>{{ $encargado->sede->nombre }} </p>
                <p><strong>Celular: </strong>{{ $encargado->celular }} </p>
            </div>
        </div>

    </div>
</div>
