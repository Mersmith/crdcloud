<div>
    <!--SEO-->
    @section('tituloPagina', 'Sede - Nuevo')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Nueva sede</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.sede.index') }}">
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
            <form wire:submit.prevent="crearSede" class="formulario">
                <!--NOMBRE Y SLUG-->
                <div class="contenedor_1_elementos_100">
                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="text" wire:model="crearFormulario.nombre">
                        @error('crearFormulario.nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DIRECCIÓN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Dirección: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <textarea rows="2" wire:model="crearFormulario.direccion"></textarea>
                        @error('crearFormulario.direccion')
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
