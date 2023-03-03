<div>
    <!--SEO-->
    @section('tituloPagina', 'Registrar')

    <!--GRID CONTENEDOR LOGIN-->
    <div class="contenedor_login">
        <!--GRID LOGIN IMAGEN-->
        <div class="contenedor_login_imagen">
            <!--IMAGEN-->
            <img src="{{ asset('imagenes/odontologos/1.jpg') }}" alt="" />
            <!--TEXTO-->
            <div>
                <h2>"Canjea tus puntos para que ahorres."</h2>
                <h3>Nickol Sinchi </h3>
                <p>Odontologa</p>
            </div>
        </div>
        <!--GRID LOGIN FORMULARIO-->
        <div class="contenedor_login_formulario">
            <!--FORMULARIO CENTRAR-->
            <div class="login_formulario_centrar">

                <div class="login_formulario_arriba">
                    <span>¿Ya tienes una cuenta?</span>
                    <a href="{{ route('inicio') }}">Ingresar</a>
                </div>

                <div class="login_formulario_logo">
                    <a href="{{ route('inicio') }}">
                        <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                    </a>
                </div>

                <h1 class="titulo_formulario">¡HOLA! Regístrate a CRD CLOUD</h1>
                <p class="descripcion_formulario">Y disfruta de grandes beneficios.
                </p>

                <form wire:submit.prevent="register" x-data="{ digitosDni: '', digitosCelular: '', digitosCop: '', digitosRuc: '' }" class="formulario"
                    style="width: 100%; margin-top: 30px;">
                    <!--SEDES Y ESPECIALIDADES-->
                    <div class="contenedor_2_elementos">
                        <!--ESPECIALIDADES-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Especialidades:</p>
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
                        <!--EMAIL-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Email:
                            </p>
                            <input type="email" wire:model="email">
                            @error('email')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--EMAIL Y PASSWORD-->
                    <div class="contenedor_2_elementos">
                        <!--PASSWORD-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Contraseña:
                            </p>
                            <input type="password" wire:model="password" autocomplete="off">
                            @error('password')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--NOMBRE-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Nombres:
                            </p>
                            <input type="text" wire:model="nombre">
                            @error('nombre')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--NOMBRE Y APELLIDO-->
                    <div class="contenedor_2_elementos">
                        <!--APELLIDO-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Apellidos:
                            </p>
                            <input type="text" wire:model="apellido">
                            @error('apellido')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--DNI-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">DNI:
                            </p>
                            <input type="number" wire:model="dni" x-ref="digitosDniRef" x-model="digitosDni"
                                x-on:keydown="limitarEntrada($refs.digitosDniRef, 8, $event)">
                            @error('dni')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--DNI Y COP-->
                    <div class="contenedor_2_elementos">
                        <!--COP-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">COP:
                            </p>
                            <input type="number" wire:model="cop" x-ref="digitosCopRef" x-model="digitosCop"
                                x-on:keydown="limitarEntrada($refs.digitosCopRef, 6, $event)">
                            @error('cop')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--CELULAR-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Celular:
                            </p>
                            <input type="number" wire:model="celular" x-ref="digitosCelularRef"
                                x-model="digitosCelular"
                                x-on:keydown="limitarEntrada($refs.digitosCelularRef, 9, $event)">
                            @error('celular')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--CELULAR Y FECHA DE NACIMIENTO-->
                    <div class="contenedor_2_elementos">
                        <!--FECHA DE NACIMIENTO-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Fecha de Nacimiento:</p>
                            <input type="date" wire:model="fecha_nacimiento">
                            @error('fecha_nacimiento')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--GÉNERO-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Género:</p>
                            <select wire:model="genero">
                                <option value="hombre">Hombre</option>
                                <option value="mujer">Mujer</option>
                            </select>
                            @error('genero')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="contenedor_1_elementos_100">
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
                            <p class="estilo_nombre_input">RUC:
                            </p>
                            <input type="number" wire:model="ruc" x-ref="digitosRucRef" x-model="digitosRuc"
                                x-on:keydown="limitarEntrada($refs.digitosRucRef, 11, $event)">
                            @error('ruc')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--NOMBRE CLÍNICA-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Nombre de la clínica:
                            </p>
                            <input type="text" wire:model="nombre_clinica">
                            @error('nombre_clinica')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ENVIAR-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <input type="submit" value="Registrar">
                        </div>
                    </div>

                </form>

            </div>
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
