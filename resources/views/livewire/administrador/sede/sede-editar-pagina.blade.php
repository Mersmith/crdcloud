<div>

    <!--SEO-->
    @section('tituloPagina', 'Sede - Editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar sede</h2>
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
            <div x-data class="formulario">
                <!--NOMBRE-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="editarFormulario.nombre">
                        @error('editarFormulario.nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DESCRIPCIÓN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">

                        <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <textarea rows="2" wire:model="editarFormulario.descripcion"></textarea>
                        @error('editarFormulario.descripcion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <button wire:loading.attr="disabled" wire:target="editarSede"
                        wire:click="editarSede">
                        Actualizar
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>
