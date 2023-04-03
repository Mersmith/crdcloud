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
                <h3>Datos:</h3>
            </div>
            <div>
                <p><strong>Nombre: </strong>{{ $clinica->nombre }} </p>
                <p><strong>Apellido: </strong>{{ $clinica->apellido }} </p>
                <p><strong>Especialidad: </strong>{{ $especialidad->nombre }} </p>
                <p><strong>COP: </strong>{{ $clinica->cop }} </p>
                <p><strong>DNI: </strong>{{ $clinica->dni }} </p>
                <p><strong>Celular: </strong>{{ $clinica->celular }} </p>
                <p><strong>Puntos: </strong>{{ $clinica->puntos }} </p>
                <p><strong>Sedes CRD: </strong>{{ implode(',', $sedes) }} </p>
                <p><strong>Fecha de Nacimiento: </strong>{{ $clinica->fecha_nacimiento }} </p>
                <p><strong>Género: </strong>{{ $clinica->genero }} </p>
                <p><strong>RUC: </strong>{{ $clinica->ruc }} </p>
                <p><strong>Empresa: </strong>{{ $clinica->nombre_clinica }} </p>
            </div>

            <!--ACCESOS-->
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Accesos:</h3>
            </div>
            <div>
                <p><strong>Username: </strong>{{ $usuario_clinica->username }} </p>
                <p><strong>Correo: </strong>{{ $usuario_clinica->email }} </p>
            </div>

            <!--PERFIL-->
            @if ($imagen)
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Perfil:</h3>
                </div>
                <div class="formulario">
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <div class="contenedor_subir_imagen_sola contenedor_subir_imagen_sola_estilo_2">
                                <img src="{{ Storage::url($clinica->imagenPerfil->imagen_perfil_ruta) }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!--PACIENTE-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>¿Es paciente?:</h3>
            </div>
            @if ($paciente)
                <div>
                    <p><strong>Paciente: </strong>Sí</p>
                    <a href="{{ route('encargado.paciente.sede.editar', $paciente) }}" target="_blank"
                        class="boton_suelto"><i class="fa-solid fa-eye"></i> Ver paciente</a>
                    <a wire:click="$emit('eliminarPacienteModal')" class="boton_suelto"><i
                            class="fa-solid fa-trash-can"></i> ¿Desasignar como paciente?</a>
                </div>
            @else
                <div>
                    <a wire:click="asignarPaciente" class="boton_suelto"><i class="fa-solid fa-user-injured"></i>
                        ¿Asignarlo también como paciente?</a>
                </div>
            @endif
        </div>

        <!--DIRECCIÓN-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Dirección:</h3>
            </div>
            @if ($direccion)
                <div>
                    <p><strong>Departamento: </strong>{{ $direccion->departamento_nombre }} </p>
                    <p><strong>Provincia: </strong>{{ $direccion->provincia_nombre }} </p>
                    <p><strong>Distrito: </strong>{{ $direccion->distrito_nombre }} </p>
                    <p><strong>Dirección: </strong>{{ $direccion->direccion }} </p>
                    <p><strong>Referencia: </strong>{{ $direccion->referencia }} </p>
                    <p><strong>Código postal: </strong>{{ $direccion->codigo_postal }} </p>
                    <a href="{{ route('encargado.clinica.sede.direccion.editar', $clinica) }}" target="_blank"
                        class="boton_suelto"><i class="fa-solid fa-pencil"></i> Editar
                        Dirección</a>
                </div>
            @else
                <div>
                    <a href="{{ route('encargado.clinica.sede.direccion.crear', $clinica) }}" target="_blank"
                        class="boton_suelto"><i class="fa-solid fa-square-plus"></i> Crear Dirección</a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('script')
    <script>  
        Livewire.on('eliminarPacienteModal', () => {
            Swal.fire({
                title: '¿Quieres desasignar?',
                text: "No podrás recuparlo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('encargado.clinica-sede.clinica-sede-informacion-pagina',
                        'desasignarPaciente');
                    Swal.fire(
                        'Desasignado!',
                        'Desasignaste correctamente.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush