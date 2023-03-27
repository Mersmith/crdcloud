<div>
    <!--SEO-->
    @section('tituloPagina', 'Editar venta')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar venta</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('odontologo.venta.odontologo.index') }}">
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
                    <!--SEDES-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Sede:</p>
                            <input type="text" value="{{ $sede->nombre }}" disabled>
                        </div>
                    </div>

                    <!--PACIENTES-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Pacientes:</p>
                            <input type="text" value="{{ $paciente->nombre . ' ' . $paciente->apellido }}" disabled>
                        </div>
                    </div>

                </div>

                <!--DATOS-->
                <div class="formulario contenedor_panel_producto_admin">

                    <!--LINK-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Link:</p>
                            <input type="text" value="{{ $link }}" disabled>
                        </div>
                    </div>

                    <!--ESTADOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Estado de venta:</p>
                            @switch($estado)
                                @case(1)
                                    <input type="text" value="Pendiente" disabled>
                                @break

                                @case(2)
                                    <input type="text" value="Pagado" disabled>
                                @break

                                @case(3)
                                    <input type="text" value="Cancelado" disabled>
                                @break

                                @default
                            @endswitch
                        </div>
                    </div>

                </div>

            </div>

            <!--GRID DETALLE-->
            <div class="grid_contenedor_venta_tabla">

                @if ($venta_detalles)

                    <!--TABLA-->
                    <div class="contenedor_panel_producto_admin tabla_administrador py-4 overflow-x-auto">
                        <div class="inline-block min-w-full overflow-hidden">
                            <table class="min-w-full leading-normal tabla_administrador_bordes">
                                <tr>
                                    <th>
                                        N°</th>
                                    <th>
                                        Servicio</th>
                                    <th>
                                        Precio</th>
                                    <th>
                                        Cantidad</th>
                                    <th>
                                        SubTotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($venta_detalles as $index => $venta_detalle)
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $servicios[$venta_detalle['servicio_id']]->nombre }}
                                            </td>
                                            <td style="text-align: center;">
                                                S/. {{ $venta_detalle['precio'] }}
                                            </td>
                                            <td style="text-align: center;">
                                                {{$venta_detalles[$index]["cantidad"]}}
                                            </td>
                                            <td style="text-align: center;">
                                                S/.
                                                {{ number_format($venta_detalle['cantidad'] * $venta_detalle['precio']) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    @php
                                        $total = array_reduce(
                                            $venta_detalles,
                                            function ($carry, $item) {
                                                return $carry + $item['cantidad'] * $item['precio'];
                                            },
                                            0,
                                        );
                                    @endphp
                                    <tr>
                                        <td style="text-align: right;" colspan="4">TOTAL:</td>
                                        <td style="text-align: center;">
                                            S/. {{ number_format($total) }}
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>

                    <!--IMAGENES-->
                    <div class="contenedor_panel_producto_admin">
                        @if ($venta->imagenes->count())
                            <div class="contenedor_1_elementos_imagen">
                                <div class="contenedor_imagenes_subidas_dropzone" id="sortableimagenes">
                                    @foreach ($venta->imagenes->sortBy('posicion') as $key => $imagen)
                                        <div wire:key="imagen-{{ $imagen->id }}" data-id="{{ $imagen->id }}">
                                            <img class="handle2 cursor-grab"
                                                src="{{ Storage::url($imagen->imagen_ruta) }}" alt="">
                                            <span class="imagen_dropzone_eliminar"
                                                wire:click="eliminarImagen({{ $imagen->id }})"
                                                wire:loading.attr="disabled"
                                                wire:target="eliminarImagen({{ $imagen->id }})">
                                                <i class="fa-solid fa-trash" style="color: white;"></i>
                                            </span>
                                            @if ($loop->first)
                                                <span class="imagen_dropzone_primero">
                                                    <i class="fa-solid fa-1" style="color: white;"></i>
                                                </span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!--INFORME-->
                    <div class="formulario contenedor_panel_producto_admin">
                        <!--INFORME-->
                        <div class="contenedor_1_elementos_100">
                            <div class="contenedor_elemento_item">
                                <p class="estilo_nombre_input">Informe: <span class="campo_opcional">(Opcional)</span>
                                </p>
                                <div class="contenedor_subir_imagen_sola">
                                    @if ($editarInforme)
                                        <img src="{{ asset('imagenes/informe/con_foto_pdf.png') }}">
                                        <span class="boton_imagen_eliminar" wire:click="$set('editarInforme', null)">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    @elseif($informe)
                                        <img src="{{ asset('imagenes/informe/con_foto_pdf.png') }}">
                                        <span class="boton_imagen_borrar" wire:click="$set('informe', null)">
                                            <i class="fa-solid fa-trash"></i>
                                        </span>
                                    @else
                                        <img src="{{ asset('imagenes/informe/sin_foto_pdf.png') }}">
                                    @endif
                                    <div class="opcion_cambiar_imagen">
                                        <label for="informeSubir">
                                            <div style="cursor: pointer;">
                                                Editar <i class="fa-solid fa-file-pdf"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @if ($informe)
                                    <a href="{{ Storage::url($venta->informes->first()->informe_ruta) }}"
                                        target="_blank">
                                        <i class="fa-solid fa-file"></i>
                                        Ver informe
                                    </a>
                                @endif
                                <input type="file" wire:model="editarInforme" style="display: none"
                                    id="informeSubir">
                                @error('editarInforme')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!--OBSERVACIÓN-->
                    <div class="formulario contenedor_panel_producto_admin">
                        <!--OBSERVACIÓN-->
                        <div class="contenedor_1_elementos_100">
                            <div class="contenedor_elemento_item">
                                <p class="estilo_nombre_input">Observación:</p>
                                <textarea rows="3" value="{{ $observacion }}" disabled></textarea>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="contenedor_panel_producto_admin contenedor_no_existe_elementos">
                        <p>No hay servicios agregados</p>
                        <i class="fa-solid fa-spinner"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
