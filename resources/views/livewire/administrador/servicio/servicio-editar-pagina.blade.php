<div>
    <!--SEO-->
    @section('tituloPagina', 'Servicio - Editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar servicio</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.servicio.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <button wire:click="$emit('eliminarServicioModal')">
                Eliminar servicio <i class="fa-solid fa-trash-can"></i>
            </button>
            <a href="{{ route('administrador.servicio.crear') }}">
                Nuevo servicio <i class="fa-solid fa-square-plus"></i></a>
            <a href="{{ route('administrador.servicio.informacion', $servicio) }}">
                Información del servicio <i class="fa-solid fa-eye"></i></a>
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
            <form wire:submit.prevent="editarServicio" class="formulario">

                <!--NOMBRE Y PRECIO REAL-->
                <div class="contenedor_2_elementos">
                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="text" wire:model="editarFormulario.nombre">
                        @error('editarFormulario.nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--PRECIO REAL-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Precio: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="number" wire:model="editarFormulario.precio_venta">
                        @error('editarFormulario.precio_venta')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DESCRIPCIÓN CORTA-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span> </p>
                        <textarea rows="3" wire:model="editarFormulario.descripcion"></textarea>
                        @error('editarFormulario.descripcion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--PUNTOS A GANAR Y PUNTOS PARA CANJEAR-->
                <div class="contenedor_2_elementos">
                    <!--PUNTOS A GANAR-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Puntos a ganar: <span
                                class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="text" wire:model="editarFormulario.puntos_ganar">
                        @error('editarFormulario.puntos_ganar')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--PUNTOS PARA CANJEAR-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Puntos para canjear: <span
                                class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="number" wire:model="editarFormulario.puntos_canjeo">
                        @error('editarFormulario.puntos_canjeo')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <input type="submit" value="Editar">
                </div>
            </form>

        </div>
    </div>
</div>

@push('script')
    <script>
        Livewire.on('eliminarServicioModal', () => {
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
                    Livewire.emitTo('administrador.servicio.servicio-editar-pagina',
                        'eliminarServicio');
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
