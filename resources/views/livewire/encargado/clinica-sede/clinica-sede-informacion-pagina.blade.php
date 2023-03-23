<div>
    <!--SEO-->
    @section('tituloPagina', 'Clínica - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Clínica: {{ $clinica->nombre }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('encargado.clinica.sede.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('encargado.clinica.sede.paciente.todo', $clinica) }}">
                Pacientes <i class="fa-solid fa-user-injured"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos del odontólogo:</h3>
            </div>
            <div>
                <p><strong>Nombre: </strong>{{ $clinica->nombre }} </p>
                <p><strong>Correo: </strong>{{ $usuario_clinica->email }} </p>
                <p><strong>Especialidad: </strong>{{ $especialidad->nombre }} </p>
                <p><strong>COP: </strong>{{ $clinica->cop }} </p>
                <p><strong>DNI: </strong>{{ $clinica->dni }} </p>
                <p><strong>Celular: </strong>{{ $clinica->celular }} </p>
                <p><strong>Email: </strong>{{ $clinica->email }} </p>
                <p><strong>Puntos: </strong>{{ $clinica->puntos }} </p>
            </div>
        </div>

        <!--PACIENTE-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos del paciente:</h3>
            </div>
            @if ($paciente)
                <div>
                    <p><strong>Paciente: </strong>Sí</p>
                    <a wire:click="desasignarPaciente" class="boton_suelto">¿Desasignar como paciente?</a>
                </div>
            @else
                <div>
                    <a wire:click="asignarPaciente" class="boton_suelto">¿Asignarlo también como paciente?</a>
                </div>
            @endif
        </div>

        <!--DIRECCIÓN-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Dirección del odontólogo:</h3>
            </div>
            @if ($direccion)
                <div>
                    <p><strong>Departamento: </strong>{{ $direccion->departamento_nombre }} </p>
                    <p><strong>Provincia: </strong>{{ $direccion->provincia_nombre }} </p>
                    <p><strong>Distrito: </strong>{{ $direccion->distrito_nombre }} </p>
                    <p><strong>Dirección: </strong>{{ $direccion->direccion }} </p>
                    <p><strong>Referencia: </strong>{{ $direccion->referencia }} </p>
                    <p><strong>Código postal: </strong>{{ $direccion->codigo_postal }} </p>
                    <a href="{{ route('encargado.clinica.sede.direccion.editar', $clinica) }}"
                        class="boton_suelto">Editar
                        Dirección</a>
                </div>
            @else
                <div>
                    <a href="{{ route('encargado.clinica.sede.direccion.crear', $clinica) }}"
                        class="boton_suelto">Crear Dirección</a>
                </div>
            @endif
        </div>
    </div>
</div>
