<div>
    <!--SEO-->
    @section('tituloPagina', 'Clínica - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Clínica: {{ $clinica->nombre_clinica }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.clinica.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('administrador.clinica.paciente.todo', $clinica) }}">
                Pacientes <i class="fa-solid fa-user-injured"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos de la clínica:</h3>
            </div>
            <div>
                <p><strong>Clinica: </strong>{{ $clinica->nombre_clinica }} </p>
                <p><strong>RUC: </strong>{{ $clinica->ruc }} </p>
                <p><strong>Nombre: </strong>{{ $clinica->nombre }} </p>
                <p><strong>Correo: </strong>{{ $usuario_clinica->email }} </p>
                <p><strong>Sede: </strong>{{ $clinica->sede->nombre }} </p>
                <p><strong>Especialidad: </strong>{{ $especialidad->nombre }} </p>
                <p><strong>COP: </strong>{{ $usuario_clinica->cop }} </p>
                <p><strong>DNI: </strong>{{ $usuario_clinica->dni }} </p>
                <p><strong>Celular: </strong>{{ $clinica->celular }} </p>
                <p><strong>Email: </strong>{{ $clinica->email }} </p>
                <p><strong>Puntos: </strong>{{ $clinica->puntos }} </p>
            </div>
        </div>

        <!--DIRECCIÓN-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Dirección de la clínica:</h3>
            </div>
            @if ($direccion)
                <div>
                    <p><strong>Departamento: </strong>{{ $direccion->departamento_nombre }} </p>
                    <p><strong>Provincia: </strong>{{ $direccion->provincia_nombre }} </p>
                    <p><strong>Distrito: </strong>{{ $direccion->distrito_nombre }} </p>
                    <p><strong>Dirección: </strong>{{ $direccion->direccion }} </p>
                    <p><strong>Referencia: </strong>{{ $direccion->referencia }} </p>
                    <p><strong>Código postal: </strong>{{ $direccion->codigo_postal }} </p>
                    <a href="{{ route('administrador.clinica.direccion.editar', $clinica) }}"
                        class="boton_suelto">Editar
                        Dirección</a>
                </div>
            @else
                <div>
                    <a href="{{ route('administrador.clinica.direccion.crear', $clinica) }}" class="boton_suelto">Crear
                        Dirección</a>
                </div>
            @endif
        </div>
    </div>
</div>
