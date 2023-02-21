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
            <a href="{{ route('administrador.clinica.index') }}">
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
            <form wire:submit.prevent="crearClinica" x-data class="formulario">

                <!--SEDES Y ESPECIALIDADES-->
                <div class="contenedor_2_elementos">
                    <!--SEDES-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Sedes: <span class="campo_obligatorio">(Obligatorio)</span></p>
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
                    <!--DNI-->
                    <div class="contenedor_elemento_item">
                        <p>DNI: </p>
                        <input type="number" wire:model="dni">
                        @error('dni')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--COP-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">COP: <span class="campo_obligatorio">(Obligatorio)</span> </p>
                        <input type="number" wire:model="cop">
                        @error('cop')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--CELULAR Y FECHA DE NACIMIENTO-->
                <div class="contenedor_2_elementos">
                    <!--CELULAR-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Celular: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="tel" wire:model="celular">
                        @error('celular')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--FECHA DE NACIMIENTO-->
                    <div class="contenedor_elemento_item">
                        <p>Fecha de Nacimiento: </p>
                        <input type="date" wire:model="fecha_nacimiento">
                        @error('fecha_nacimiento')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--PUNTOS Y GÉNERO-->
                <div class="contenedor_2_elementos">
                    <!--PUNTOS-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">PUNTOS: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="puntos">
                        @error('puntos')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--GÉNERO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Genero: <span class="campo_obligatorio">(Obligatorio)</span></p>
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
                        <input type="text" wire:model="ruc">
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
