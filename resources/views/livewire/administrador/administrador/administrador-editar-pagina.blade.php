<div>
    <!--SEO-->
    @section('tituloPagina', 'Administrador - Editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar administrador</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.administrador.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <button wire:click="$emit('eliminarAdministradorModal')">
                Eliminar administrador <i class="fa-solid fa-trash-can"></i>
            </button>
            <a href="{{ route('administrador.administrador.crear') }}">
                Nuevo administrador <i class="fa-solid fa-square-plus"></i></a>
            <a href="{{ route('administrador.administrador.informacion', $administrador) }}">
                Información del administrador <i class="fa-solid fa-eye"></i></a>
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

                <!--ESPECIALIDADES Y EMAIL-->
                <div class="contenedor_2_elementos">
                    <!--ESPECIALIDADES-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Sedes: <span
                                class="campo_obligatorio">(Obligatorio)</span></p>
                        <select wire:model="sede_id">
                            <option value="" selected disabled>Seleccione una sede</option>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                            @endforeach
                        </select>
                        @error('sede_id')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--EMAIL-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Correo: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="email" wire:model="email">
                        @error('email')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--PASSWORD Y NUEVO PASSWORD-->
                <div class="contenedor_2_elementos">
                    <!--PASSWORD-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Contraseña actual: <span
                                class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="password" wire:model="password" disabled>
                        @error('password')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--NUEVO PASSWORD-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nueva contraseña: <span
                                class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="password" wire:model="editar_password" autocomplete="off">
                        @error('editar_password')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--NOMBRE Y APELLIDO-->
                <div class="contenedor_2_elementos">
                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombres: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="nombre">
                        @error('nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--APELLIDO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Apellidos: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="apellido">
                        @error('apellido')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DNI-->
                <div class="contenedor_2_elementos">
                    <!--DNI-->
                    <div class="contenedor_elemento_item">
                        <p>DNI: </p>
                        <input type="number" wire:model="dni">
                        @error('dni')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <button wire:loading.attr="disabled" wire:target="editarAdministrador" wire:click="editarAdministrador">
                        Actualizar
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

@push('script')
    <script>
        Livewire.on('eliminarClienteModal', () => {
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
                    Livewire.emitTo('administrador.cliente.cliente-editar-livewire',
                        'eliminarCliente');
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
