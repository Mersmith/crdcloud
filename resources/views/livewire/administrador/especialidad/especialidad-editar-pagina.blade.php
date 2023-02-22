<div>

    <!--SEO-->
    @section('tituloPagina', 'Especialidad - Editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar especialidad</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.especialidad.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <button wire:click="$emit('eliminarEspecialidadModal')">
                Eliminar especialidad <i class="fa-solid fa-trash-can"></i>
            </button>
            <a href="{{ route('administrador.especialidad.crear') }}">
                Nueva especialidad <i class="fa-solid fa-square-plus"></i></a>
            <a href="{{ route('administrador.especialidad.informacion', $especialidad) }}">
                Información de la especialidad <i class="fa-solid fa-eye"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <div class="contenedor_panel_producto_admin">

            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Formulario</h3>
            </div>
            <!--FORMULARIO-->
            <div x-data class="formulario">
                <!--NOMBRE-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="editarFormulario.nombre">
                        @error('editarFormulario.nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DESCRIPCIÓN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">

                        <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <textarea rows="2" wire:model="editarFormulario.descripcion"></textarea>
                        @error('editarFormulario.descripcion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <button wire:loading.attr="disabled" wire:target="editarEspecialidad"
                        wire:click="editarEspecialidad">
                        Actualizar
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>

@push('script')
    <script>
        Livewire.on('eliminarEspecialidadModal', () => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recuparlo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('administrador.especialidad.especialidad-editar-pagina',
                        'eliminarEspecialidad');
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
