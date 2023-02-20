<div>
    <!--SEO-->
    @section('tituloPagina', 'Categorias')


    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido" x-data>
        <!--FORMULARIOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Nueva especilidad</h3>
            </div>
            <form wire:submit.prevent="crearEspecialidad" class="formulario">
                <!--NOMBRE Y SLUG-->
                <div class="contenedor_2_elementos">
                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="text" wire:model="crearFormulario.nombre">
                        @error('crearFormulario.nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DESCRIPCIÓN-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span>
                        </p>
                        <textarea rows="2" wire:model="crearFormulario.descripcion"></textarea>
                        @error('crearFormulario.descripcion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <input type="submit" value="Crear especialidad">
                </div>
            </form>
        </div>
    </div>
</div>
