<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontologo - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>{{ $administrador->sede->nombre }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.administrador.index') }}">
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
                <p><strong>Nombre: </strong>{{ $administrador->nombre }} </p>
                <p><strong>Apellido: </strong>{{ $administrador->apellido }} </p>
                <p><strong>Correo: </strong>{{ $administrador->email }} </p>
                <p><strong>Sede: </strong>{{ $administrador->sede->nombre }} </p>
                <p><strong>Celular: </strong>{{ $administrador->celular }} </p>
            </div>
        </div>

    </div>
</div>
