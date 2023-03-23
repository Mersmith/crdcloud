<div>
    <!--SEO-->
    @section('tituloPagina', 'Clínica - Nuevo')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Nuevo clínica</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('encargado.clinica.sede.index') }}">
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
            <form wire:submit.prevent="crearClinica" x-data="{ digitosDni: '', digitosCelular: '', digitosCop: '', digitosRuc: '' }" class="formulario">

                <!--SEDES Y ESPECIALIDADES-->
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

                <!--DNI Y COP-->
                <div class="contenedor_2_elementos">
                     <!--USERNAME-->
                     <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Username: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="username">
                        @error('username')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--DNI-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">DNI: <span class="campo_obligatorio">(Obligatorio)</span> </p>
                        <input type="number" wire:model="dni" x-ref="digitosDniRef" x-model="digitosDni"
                            x-on:keydown="limitarEntrada($refs.digitosDniRef, 8, $event)">
                        @error('dni')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--CELULAR Y FECHA DE NACIMIENTO-->
                <div class="contenedor_2_elementos">
                      <!--COP-->
                      <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">COP: <span class="campo_obligatorio">(Obligatorio)</span> </p>
                        <input type="number" wire:model="cop" x-ref="digitosCopRef" x-model="digitosCop"
                            x-on:keydown="limitarEntrada($refs.digitosCopRef, 6, $event)">
                        @error('cop')
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

                <!--PUNTOS Y GÉNERO-->
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
                        <p class="estilo_nombre_input">PUNTOS: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="puntos">
                        @error('puntos')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--GÉNERO-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Genero: <span class="campo_obligatorio">(Obligatorio)</span>
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

                <!--RUC Y NOMBRE CLÍNICA-->
                <div class="contenedor_2_elementos">
                    <!--RUC-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">RUC: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="number" wire:model="ruc" x-ref="digitosRucRef" x-model="digitosRuc"
                            x-on:keydown="limitarEntrada($refs.digitosRucRef, 11, $event)">
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
