<div>
    <!--SEO-->
    @section('tituloPagina', 'Clínica - Editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar clínica</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('encargado.clinica.sede.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <button wire:click="$emit('eliminarClinicaModal')">
                Eliminar clínica <i class="fa-solid fa-trash-can"></i>
            </button>
            <a href="{{ route('encargado.clinica.sede.crear') }}">
                Nueva clínica <i class="fa-solid fa-square-plus"></i></a>
            <a href="{{ route('encargado.clinica.sede.informacion', $clinica) }}">
                Información de la clínica <i class="fa-solid fa-eye"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">
        <!--ACTUALIZAR FORMULARIO-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Formulario</h3>
            </div>

            <!--FORMULARIO-->
            <div x-data="{ digitosDni: '', digitosCelular: '', digitosCop: '', digitosRuc: '' }" class="formulario">

                <!--SEDES-->
                <div class="contenedor_2_elementos">
                    <!--SEDES-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Sedes: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <select wire:model="sedesSeleccionadas" id="sedesSeleccionadas" name="sedesSeleccionadas[]"
                            multiple>
                            @foreach ($sedes as $sede)
                                <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                            @endforeach
                        </select>
                        @error('sedesSeleccionadas')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ESPECIALIDADES Y NOMBRE-->
                <div class="contenedor_2_elementos">
                    <!--ESPECIALIDADES-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Especialidades: <span
                                class="campo_obligatorio">(Obligatorio)</span></p>
                        <select wire:model="especialidad_id">
                            <option value="" selected disabled>Seleccione una especialidad</option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                        @error('especialidad_id')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombres: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="nombre">
                        @error('nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--APELLIDO Y DNI-->
                <div class="contenedor_2_elementos">
                    <!--APELLIDO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Apellidos: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="apellido">
                        @error('apellido')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--DNI-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">DNI: </p>
                        <input type="number" wire:model="dni" x-ref="digitosDniRef"
                            x-on:keydown="limitarEntrada($refs.digitosDniRef, 8, $event)" x-init="digitosDni = $refs.digitosDniRef.value">
                        @error('dni')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--COP Y CELULAR-->
                <div class="contenedor_2_elementos">
                    <!--COP-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">COP: <span class="campo_obligatorio">(Obligatorio)</span> </p>
                        <input type="number" wire:model="cop">
                        @error('cop')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                      <!--CELULAR-->
                      <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Celular: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="celular" x-ref="digitosCelularRef"
                            x-on:keydown="limitarEntrada($refs.digitosCelularRef, 9, $event)" x-init="digitosCelular = $refs.digitosCelularRef.value">
                        @error('celular')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--FECHA DE NACIMIENTO Y PUNTOS-->
                <div class="contenedor_2_elementos">
                    <!--FECHA DE NACIMIENTO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Fecha de Nacimiento: <span
                                class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="date" wire:model="fecha_nacimiento">
                        @error('fecha_nacimiento')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                       <!--PUNTOS-->
                       <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Puntos:
                        </p>
                        <input type="number" value="{{$puntos}}" disabled>
                        @error('puntos')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--GÉNERO-->
                <div class="contenedor_2_elementos">
                    <!--GÉNERO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Género: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <div>
                            <label>
                                <input type="radio" value="hombre" name="genero" wire:model="genero">
                                Hombre
                            </label>
                            <label>
                                <input type="radio" value="mujer" name="genero" wire:model="genero">
                                Mujer
                            </label>
                        </div>
                        @error('genero')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--NOMBRE CLÍNICA-->
                <div class="contenedor_2_elementos">
                    <!--RUC-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">RUC: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="ruc" x-ref="digitosRucRef"
                            x-on:keydown="limitarEntrada($refs.digitosRucRef, 11, $event)" x-init="digitosRuc = $refs.digitosRucRef.value">
                        @error('ruc')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--NOMBRE CLÍNICA-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre de la clínica: <span
                                class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="nombre_clinica">
                        @error('nombre_clinica')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <button wire:loading.attr="disabled" wire:target="editarClinica" wire:click="editarClinica">
                        Actualizar
                    </button>
                </div>
            </div>
        </div>

        <!--ACTUALIZAR ACCESO-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Actualizar acceso:</h3>
            </div>

            <!--FORMULARIO-->
            <div class="formulario">
                <!--EMAIL-->
                <div class="contenedor_2_elementos">
                    <!--EMAIL-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Correo: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="email" wire:model="email">
                        @error('email')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--USERNAME-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Username:
                        </p>
                        <input type="text" wire:model="username" disabled>
                        @error('username')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--PASSWORD Y NUEVO PASSWORD-->
                <div class="contenedor_2_elementos">
                    <!--PASSWORD-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Contraseña actual:</p>
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

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <button wire:loading.attr="disabled" wire:target="editarAcceso" wire:click="editarAcceso">
                        Actualizar acceso
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

@push('script')
    <script>
        function limitarEntrada(input, longitudMaxima, event) {
            const valor = input.value;

            if (valor.length >= longitudMaxima && event.key !== 'Backspace' && event.key !== 'Delete' &&
                event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') {
                event.preventDefault();
            }
        }

        Livewire.on('eliminarClinicaModal', () => {
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
                    Livewire.emitTo('encargado.clinica-sede.clinica-sede-editar-pagina',
                        'eliminarClinica');
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
