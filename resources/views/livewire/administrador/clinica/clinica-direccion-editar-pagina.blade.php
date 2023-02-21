<div>
    <!--SEO-->
    @section('tituloPagina', 'Clínica - Dirección editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar dirección</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.clinica.informacion', $clinica) }}">
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
            <form wire:submit.prevent="editarDireccion" class="formulario">

                <!--DIRECCIÓN Y REFERENCIA-->
                <div class="contenedor_2_elementos">
                    <!--DIRECCIÓN-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Dirección:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="direccion">
                        @error('direccion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--REFERENCIA-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Referencia:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="referencia">
                        @error('referencia')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--CÓDIGO POSTAL Y REGIÓN-->
                <div class="contenedor_2_elementos">
                    <!--CÓDIGO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Código postal:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="codigo_postal">
                        @error('codigo_postal')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--REGIÓN-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Región:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <select wire:model="departamento_id">
                            <option value="" selected disabled>Seleccione su región</option>
                            @foreach ($departamentos as $keyDeparmento => $departamento)
                                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                            @endforeach
                        </select>
                        @error('departamento_id')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--PROVINCIA Y DISTRITO-->
                <div class="contenedor_2_elementos">
                    <!--PROVINCIA-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Provincia:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <select wire:model="provincia_id">
                            <option value="" selected disabled>Seleccione su provincia:</option>
                            @foreach ($provincias as $provincia)
                                <option value="{{ $provincia->id }}">{{ $provincia->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('provincia_id')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--Distrito-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Distrito:
                            <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <select wire:model="distrito_id">
                            <option value="" selected disabled>Seleccione su distrito:</option>
                            @foreach ($distritos as $distrito)
                                <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                            @endforeach
                        </select>
                        @error('distrito_id')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--Enviar-->
                <div class="contenedor_1_elementos">
                    <input type="submit" value="Actualizar Dirección">
                </div>
            </form>

        </div>
    </div>

</div>
