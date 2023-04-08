<div>

    <!--SEO-->
    @section('tituloPagina', 'Especialidad - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Especialidad: {{ $especialidad->nombre }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.especialidad.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('administrador.especialidad.estadistica.odontologo.lista', $especialidad->id) }}">
                Lista odontólogos <i class="fa-solid fa-user-doctor"></i></a>
            <a href="{{ route('administrador.especialidad.estadistica.clinica.lista', $especialidad->id) }}">
                Lista clínicas <i class="fa-solid fa-user-doctor"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos de la especialidad:</h3>
            </div>
            <div>
                <p><strong>Nombre: </strong>{{ $especialidad->nombre }} </p>
                <p><strong>Descripción: </strong>{{ $especialidad->descripcion }} </p>
            </div>
        </div>

        <!--Odontólogos-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Odontólogos</h3>
            </div>
            <div>
                <p><strong>Cantidad: </strong>{{ $cantidad_total_odontologos }} </p>
            </div>
        </div>

        <!--Odontólogos-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Clínicas</h3>
            </div>
            <div>
                <p><strong>Cantidad: </strong>{{ $cantidad_total_clinicas }} </p>
            </div>
        </div>

    </div>

</div>
