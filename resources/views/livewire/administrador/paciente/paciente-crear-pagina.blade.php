<div>
    <!--SEO-->
    @section('tituloPagina', 'Paciente - Nuevo')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Nuevo paciente</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.paciente.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
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
            <form wire:submit.prevent="crearPaciente" x-data="{ digitosDni: '', digitosCelular: '' }" class="formulario">
                <!--ODONTOLOGOS Y CLINICAS-->
                <div class="contenedor_2_elementos">
                    <!--ODONTOLOGOS-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Odontólogos: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <select wire:model="odontologo_id">
                            <option value="" selected disabled>Seleccione un odontólgo</option>
                            @foreach ($odontologos as $odontologo)
                                <option value="{{ $odontologo->id }}">
                                    {{ $odontologo->nombre . ' ' . $odontologo->apellido }}</option>
                            @endforeach
                        </select>
                        @error('odontologo_id')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--CLINICAS-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Clínicas: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <select wire:model="clinica_id">
                            <option value="" selected disabled>Seleccione una clínica</option>
                            @foreach ($clinicas as $clinica)
                                <option value="{{ $clinica->id }}">
                                    {{ $clinica->nombre_clinica . ' - ' . $clinica->nombre . ' ' . $clinica->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('clinica_id')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--EMAIL Y PASSWORD-->
                <div class="contenedor_2_elementos">
                    <!--EMAIL-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Correo: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="email" wire:model="email">
                        @error('email')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--PASSWORD-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Contraseña: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="password" wire:model="password" autocomplete="off">
                        @error('password')
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

                <!--NOMBRE Y APELLIDO-->
                <div class="contenedor_2_elementos">
                    <!--DNI-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">DNI: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="dni" x-ref="digitosDniRef" x-model="digitosDni"
                            x-on:keydown="limitarEntrada($refs.digitosDniRef, 8, $event)">
                        @error('dni')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--CELULAR-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Celular: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="celular" x-ref="digitosCelularRef" x-model="digitosCelular"
                            x-on:keydown="limitarEntrada($refs.digitosCelularRef, 9, $event)">
                        @error('celular')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--FECHA DE NACIMIENTO Y GÉNERO-->
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

                    <!--GÉNERO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Género: <span class="campo_obligatorio">(Obligatorio)</span></p>
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

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <input type="submit" value="Crear">
                </div>
            </form>

        </div>
    </div>
</div>

@push('script')
    <script>
        function limitarEntrada(input, longitudMaxima, event) {
            const valor = input.value;

            if (valor.length >= longitudMaxima && event.key !== 'Backspace' && event.key !== 'Delete' && event.key !==
                'ArrowLeft' && event.key !== 'ArrowRight') {
                event.preventDefault();
            }
        }
    </script>
@endpush
