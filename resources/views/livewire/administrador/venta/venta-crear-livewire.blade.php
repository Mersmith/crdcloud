<div>
    <!--SEO-->
    @section('tituloPagina', 'Crear venta')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Crear venta</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.venta.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR CONTENIDO-->
    <div class="contenedor_administrador_contenido" x-data>


        <!--FORMULARIO-->
        <div x-data class="formulario contenedor_panel_producto_admin">

            <!--ENCARGADO-->
            <div class="contenedor_1_elementos_100">
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Encargados: <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <select wire:model="encargado_id">
                        <option value="" selected>Seleccione un encargado de sede</option>
                        @foreach ($encargados as $encargadoItem)
                            <option value="{{ $encargadoItem->id }}">{{ $encargadoItem->nombre }}</option>
                        @endforeach
                    </select>
                    @error('encargado_id')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--ODONTOLOGOS Y CLINICAS-->
            <div class="contenedor_2_elementos">
                <!--ODONTOLOGOS-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Odontólogos: <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <select wire:model="odontologo_id">
                        <option value="" selected disabled>Seleccione un odontólgo</option>
                        @foreach ($odontologos as $odontologoItem)
                            <option value="{{ $odontologoItem->id }}">{{ $odontologoItem->nombre }}</option>
                        @endforeach
                    </select>
                    @error('odontologo_id')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--CLINICAS-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Clínicas: <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <select wire:model="clinica_id">
                        <option value="" selected disabled>Seleccione una clínica</option>
                        @foreach ($clinicas as $clinicaItem)
                            <option value="{{ $clinicaItem->id }}">{{ $clinicaItem->nombre }}</option>
                        @endforeach
                    </select>
                    @error('clinica_id')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--PACIENTES Y SERVICIOS-->
            <div class="contenedor_2_elementos">
                <!--PACIENTES-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Pacientes: <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <select wire:model="paciente_id">
                        <option value="" selected disabled>Seleccione un odontólgo</option>
                        @foreach ($pacientes as $pacienteItem)
                            <option value="{{ $pacienteItem->id }}">{{ $pacienteItem->nombre }}</option>
                        @endforeach
                    </select>
                    @error('paciente_id')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--SERVICIOS-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Servicios: <span class="campo_obligatorio">(Obligatorio)</span>
                    </p>
                    <select wire:model="servicio">
                        <option value="" selected disabled>Seleccione una clínica</option>
                        @foreach ($servicios as $servicioItem)
                            <option value="{{ $servicioItem }}">{{ $servicioItem->nombre }}</option>
                        @endforeach
                    </select>
                    @error('servicio')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!--ENVIAR-->
            <div class="contenedor_1_elementos">
                <button wire:target="agregarCarrito" wire:click="agregarCarrito">
                    Agregar servicio
                </button>
            </div>

        </div>

        <!--LISTA-->
        <div class="contenedor_panel_producto_admin">
            @if (count($carrito) > 0)
                <!--TABLA-->
                <div class="tabla_administrador py-4 overflow-x-auto">
                    <div class="inline-block min-w-full overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <tr>
                                <th>
                                    Nombre</th>
                                <th>
                                    Precio</th>
                                <th>
                                    Cantidad</th>
                                <th>
                                    SubTotal</th>
                                <th>
                                    Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($carrito as $carritoItem)
                                    <tr>
                                        <td>
                                            {{ $carritoItem['nombre'] }}
                                        </td>
                                        <td>
                                            {{ $carritoItem['precio'] }}
                                        </td>
                                        <td>
                                            {{ $carritoItem['cantidad'] }}
                                        </td>
                                        <td>
                                            {{ $carritoItem['subtotal_compra'] }}
                                        </td>
                                        <td>
                                            <a wire:click="eliminarServicioCarrito({{ $loop->index }})"> <span><i
                                                        class="fa-solid fa-pencil"></i></span>
                                                Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            @php
                                $array_columna = 'subtotal_compra';
                                $total = array_sum(array_column($carrito, $array_columna));
                            @endphp
                            <tfoot>
                                <tr>
                                    <td style="text-align: right;" colspan="4">TOTAL:</td>
                                    <td style="text-align: end;">
                                        ${{ $total }}
                                    </td>
                                </tr>
                            </tfoot>

                        </table>

                        <!--ENVIAR-->
                        <div>
                            <button wire:loading.attr="disabled" wire:target="crearCompra" wire:click="crearCompra">
                                Crear compra
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay elementos</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

    </div>
