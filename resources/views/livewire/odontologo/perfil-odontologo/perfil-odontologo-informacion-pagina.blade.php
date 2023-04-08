<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontólogo - Perfil')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Mi perfil</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('odontologo.paciente.odontologo.index') }}">
                Mis pacientes <i class="fa-solid fa-user-injured"></i></a>
            <a href="{{ route('odontologo.venta.odontologo.index') }}">
                Mis radiografías <i class="fa-solid fa-images"></i></a>
            <a href="{{ route('odontologo.puntos.odontologo.index') }}">
                Mis puntos <i class="fa-solid fa-arrows-to-circle"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS PERSONALES-->
        <div class="contenedor_panel_producto_admin">

            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos personales:</h3>
            </div>

            <!--FORMULARIO-->
            <div x-data="{ digitosDni: '', digitosCelular: '', digitosCop: '', digitosRuc: '' }" class="formulario">

                <!--SEDES-->
                <div class="contenedor_1_elementos_100">
                    <!--SEDES-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Sede CRD:
                        </p>
                        <input type="text" value="{{ implode(',', $sedes) }}" disabled>
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
                        <p class="estilo_nombre_input">DNI: <span class="campo_obligatorio">(Obligatorio)</span></p>
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
                        <p class="estilo_nombre_input">COP:</p>
                        <input type="number" value="{{$cop}}" disabled>
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
                        <input type="text" value="{{ $puntos }}" disabled>
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

                <!--TIENE CLÍNICA-->
                <div class="contenedor_1_elementos_100">
                    <!--TIENE CLÍNICA-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">¿Tiénes una clínica?</p>
                        <div>
                            <label>
                                <input type="radio" value="1" name="tiene_clinica"
                                    wire:model.defer="tiene_clinica" x-on:click="$wire.tiene_clinica = true">
                                Sí
                            </label>
                            <label>
                                <input type="radio" value="0" name="tiene_clinica"
                                    wire:model.defer="tiene_clinica" x-on:click="$wire.tiene_clinica = false">
                                No
                            </label>
                        </div>
                    </div>
                </div>
                <!--RUC Y NOMBRE CLÍNICA-->
                <div class="contenedor_2_elementos" x-show="$wire.tiene_clinica">
                    <!--RUC-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">RUC: <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="number" wire:model="ruc" x-ref="digitosRucRef"
                            x-on:keydown="limitarEntrada($refs.digitosRucRef, 11, $event)" x-init="digitosRuc = $refs.digitosRucRef.value">
                        @error('ruc')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--NOMBRE CLÍNICA-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre de la clínica: <span
                                class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="text" wire:model="nombre_clinica">
                        @error('nombre_clinica')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <button wire:loading.attr="disabled" wire:target="editarOdontologo"
                        wire:click="editarOdontologo">
                        Actualizar datos
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
                        <p class="estilo_nombre_input">Username:</p>
                        <input type="text" value="{{$username}}" disabled>
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

        <!--ACTUALIZAR IMAGEN-->
        <div class="contenedor_panel_producto_admin">

            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Actualizar foto:</h3>
            </div>

            <!--FORMULARIO-->
            <div class="formulario">

                <!--IMAGEN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Imagen: <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <div class="contenedor_subir_imagen_sola contenedor_subir_imagen_sola_estilo_2">
                            @if ($editarImagen)
                                <img src="{{ $editarImagen->temporaryUrl() }}">
                                <span class="boton_imagen_eliminar" wire:click="$set('editarImagen', null)">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                            @elseif($imagen)
                                <img src="{{ Storage::url($odontologo->imagenPerfil->imagen_perfil_ruta) }}">
                                <span class="boton_imagen_borrar" wire:click="$set('imagen', null)">
                                    <i class="fa-solid fa-trash"></i>
                                </span>
                            @else
                                <img src="{{ asset('imagenes/perfil/sin_foto_perfil.png') }}">
                            @endif

                            <div class="opcion_cambiar_imagen">
                                <label for="imagen">
                                    <div style="cursor: pointer;">
                                        Editar <i class="fa-solid fa-camera"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <input type="file" wire:model="editarImagen" style="display: none" id="imagen">
                        @error('editarImagen')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <button wire:loading.attr="disabled" wire:target="editarImagen" wire:click="editarImagen">
                        Actualizar foto
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
    </script>
@endpush
