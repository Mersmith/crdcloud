<div>
    <!--SEO-->
    @section('tituloPagina', 'Crear canjeo')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Crear canjeo</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('odontologo.canjeo.odontologo.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido" x-data>

        <!--GRID CONTENEDOR VENTA-->
        <div class="grid_contenedor_venta">

            <!--GRID FORMULARIO-->
            <div x-data class="grid_contenedor_venta_formulario formulario">

                <!--FORMULARIO-->
                <div class="formulario contenedor_panel_producto_admin">

                    <!--MIS PUNTOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Mis puntos:</p>
                            <div style="display: flex; align-items: center;">
                                <span style="color: #189bb6; font-size: 26px;">{{ $puntos }}</span>
                                <img style="height: 24px;" src="{{ asset('imagenes/empresa/crd-puntos.png') }}"
                                    alt="" />
                            </div>
                        </div>
                    </div>

                    <!--SEDES-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Sedes: <span class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="sede_id">
                                <option value="" selected>Seleccione una sede</option>
                                @foreach ($sedes as $sedeItem)
                                    <option value="{{ $sedeItem->id }}">{{ $sedeItem->nombre }}</option>
                                @endforeach
                            </select>
                            @error('sede_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--SERVICIOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Servicios: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="servicio">
                                <option value="" selected disabled>Seleccione un servicio</option>
                                @foreach ($servicios as $servicioItem)
                                    <option value="{{ $servicioItem }}">
                                        {{ $servicioItem->nombre . ' - Puntos: ' . $servicioItem->puntos_canjeo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('servicio')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ENVIAR-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_1_elementos">
                            <button wire:target="agregarCarrito" wire:click="agregarCarrito">
                                Agregar servicio
                            </button>
                        </div>
                    </div>

                </div>

                <!--DATOS-->
                <div class="formulario contenedor_panel_producto_admin">
                    <!--NOMBRE-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="text" wire:model="nombre">
                            @error('nombre')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!--APELLIDO-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Apellido: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="text" wire:model="apellido">
                            @error('apellido')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!--DNI-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">DNI: <span class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="number" wire:model="dni">
                            @error('dni')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            <!--GRID DETALLE-->
            <div class="grid_contenedor_venta_tabla">

                <!--TABLA-->
                <div class="contenedor_panel_producto_admin tabla_administrador py-4 overflow-x-auto">

                    <div class="inline-block min-w-full overflow-hidden">
                        <table class="min-w-full leading-normal tabla_administrador_bordes">
                            <!--CABEZA-->
                            <thead>
                                <tr>
                                    <th>
                                        N°</th>
                                    <th>
                                        Exámen</th>
                                    <th>
                                        Puntos</th>
                                    <th>
                                        Cantidad</th>
                                    <th>
                                        SubTotal Puntos</th>
                                </tr>
                            </thead>
                            @if (count($carrito) > 0)
                                <!--CUERPO-->
                                <tbody>
                                    @foreach ($carrito as $carritoItem)
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $carritoItem['nombre'] }}
                                                <br>
                                                <a wire:click="eliminarServicioCarrito({{ $loop->index }})">
                                                    <span><i class="fa-solid fa-pencil"></i></span>
                                                    Eliminar</a>
                                            </td>
                                            <td style="text-align: center;">
                                                {{ $carritoItem['puntos'] }}
                                            </td>
                                            <td style="text-align: center;">
                                                {{ $carritoItem['cantidad'] }}
                                            </td>
                                            <td style="text-align: center;">

                                                {{ $carritoItem['subtotal_canjeo'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                @php
                                    $array_columna = 'subtotal_canjeo';
                                    $total = array_sum(array_column($carrito, $array_columna));
                                @endphp
                                <!--PIE-->
                                <tfoot>
                                    <tr>
                                        <td style="text-align: right;" colspan="4">TOTAL PUNTOS:</td>
                                        <td style="text-align: center;">
                                            {{ $total }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>

                </div>
                @if (count($carrito) > 0)
                    <!--OBSERVACIÓN-->
                    <div class="formulario contenedor_panel_producto_admin">
                        <!--OBSERVACIÓN-->
                        <div class="contenedor_1_elementos_100">
                            <div class="contenedor_elemento_item">
                                <p class="estilo_nombre_input">Observación: <span
                                        class="campo_opcional">(Opcional)</span>
                                </p>
                                <textarea rows="3" wire:model="observacion"></textarea>
                                @error('observacion')
                                    <span class="campo_obligatorio">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!--ENVIAR-->
                    <div style="display: flex; justify-content: flex-end;">
                        <button class="boton_suelto" wire:loading.attr="disabled" wire:target="crearVenta"
                            wire:click="crearVenta">
                            Canjear
                        </button>
                    </div>
                @else
                    <div class="contenedor_panel_producto_admin contenedor_no_existe_elementos">
                        <p>No hay exámenes agregados.</p>
                        <i class="fa-solid fa-spinner"></i>
                    </div>
                @endif

            </div>

        </div>

    </div>
