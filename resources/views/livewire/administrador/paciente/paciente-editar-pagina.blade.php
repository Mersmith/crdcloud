<div>

    <!--SEO-->
    @section('tituloPagina', 'Paciente - Editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar paciente</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.paciente.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <button wire:click="$emit('eliminarOdontologoModal')">
                Eliminar paciente <i class="fa-solid fa-trash-can"></i>
            </button>
            <a href="{{ route('administrador.paciente.crear') }}">
                Nuevo paciente <i class="fa-solid fa-square-plus"></i></a>
            <a href="{{ route('administrador.paciente.informacion', $paciente) }}">
                Información del paciente <i class="fa-solid fa-eye"></i></a>
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
            <form wire:submit.prevent="editarPaciente" x-data class="formulario">
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
                        <p class="estilo_nombre_input">Contraseña actual: <span
                                class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="password" wire:model="password" disabled>
                        @error('password')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--NUEVO PASSWORD Y NOMBRE-->
                <div class="contenedor_2_elementos">
                    <!--NUEVO PASSWORD-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nueva contraseña: <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <input type="password" wire:model="editar_password" autocomplete="off">
                        @error('editar_password')
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
                        <p>DNI:  <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="dni">
                        @error('dni')
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
                        <p>Fecha de Nacimiento:  <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="date" wire:model="fecha_nacimiento">
                        @error('fecha_nacimiento')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--GÉNERO-->
                <div class="contenedor_2_elementos">
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
                    <input type="submit" value="Editar">
                </div>
            </form>

        </div>
    </div>
</div>
