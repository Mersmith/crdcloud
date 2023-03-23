<div>
    <!--SEO-->
    @section('tituloPagina', 'Servicio - Nuevo')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Nuevo servicio</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('encargado.servicio.sede.index') }}">
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
            <form wire:submit.prevent="crearServicio" class="formulario">

                <!--NOMBRE Y PRECIO REAL-->
                <div class="contenedor_2_elementos">
                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="text" wire:model="crearFormulario.nombre">
                        @error('crearFormulario.nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--PRECIO REAL-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Precio: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="number" wire:model="crearFormulario.precio_venta">
                        @error('crearFormulario.precio_venta')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--DESCRIPCIÓN CORTA-->
                <div class="contenedor_1_elementos_100">
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span> </p>
                        <textarea rows="3" wire:model="crearFormulario.descripcion"></textarea>
                        @error('crearFormulario.descripcion')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--PUNTOS A GANAR Y PUNTOS PARA CANJEAR-->
                <div class="contenedor_2_elementos">
                    <!--PUNTOS A GANAR-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Puntos a ganar: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="crearFormulario.puntos_ganar">
                        @error('crearFormulario.puntos_ganar')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--PUNTOS PARA CANJEAR-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Puntos para canjear: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="number" wire:model="crearFormulario.puntos_canjeo">
                        @error('crearFormulario.puntos_canjeo')
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
