<div>

    <!--SEO-->
    @section('tituloPagina', 'Sede - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Sede: {{ $sede->nombre }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.sede.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('administrador.sede.odontologo.todo', $sede) }}">
                Odontólogos <i class="fa-solid fa-user-doctor"></i></a>
            <a href="{{ route('administrador.sede.clinica.todo', $sede) }}">
                Clínicas <i class="fa-solid fa-house-medical-flag"></i></a>
            <a href="{{ route('administrador.sede.paciente.todo', $sede) }}">
                Pacientes <i class="fa-solid fa-user-injured"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos de la sede:</h3>
            </div>
            <div>
                <p><strong>Nombre: </strong>{{ $sede->nombre }} </p>
                <p><strong>Dirección: </strong>{{ $sede->direccion }} </p>
                <p><strong>Encargado: </strong>  {{ $sede->encargados()->first() ? $sede->encargados()->first()->nombre : 'Falta asignar' }} </p>
            </div>
        </div>

    </div>

</div>
