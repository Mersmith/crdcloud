<div>
    <!--SEO-->
    @section('tituloPagina', 'Editar venta')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Exámen</h2>
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
                    <!--ID VENTA-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Id venta:</p>
                            <input type="text" value="{{ $venta->id }}" disabled>
                        </div>
                    </div>

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
                            <a href="{{ $link }}" target="_blank"
                                style="max-width: 100%; display: inline-block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><i
                                    class="fa-brands fa-google-drive"></i> {{ $link }}</a>
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
                                                {{ $venta_detalles[$index]['cantidad'] }}
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
                                    <tr>
                                        <td style="text-align: right;" colspan="4">PUNTOS GANADOS:</td>
                                        <td style="text-align: center;">
                                            {{ $venta->puntos_ganados }}
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>

                    <!--IMAGENES-->
                    <div class="contenedor_panel_producto_admin">
                        <!--CONTENEDOR SUBTITULO-->
                        <p class="estilo_nombre_input">Imágenes:
                        </p>
                        @if ($venta->imagenes->count())
                            <div class="contenedor_1_elementos_imagen">
                                <div class="contenedor_imagenes_subidas_dropzone" id="sortableimagenes">
                                    @foreach ($venta->imagenes as $key => $imagen)
                                    <div>
                                        <a href="{{ Storage::url($imagen->imagen_ruta) }}" data-lightbox="gallery">
                                            <img src="{{ Storage::url($imagen->imagen_ruta) }}" alt="">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                <!--CONTENEDOR BOTONES-->
                                <div class="contenedor_botones_admin">
                                    <button wire:click="descargarImagenes()">
                                        Descargar imagenes en ZIP <i class="fa-solid fa-file-zipper"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!--INFORME-->
                    <div class="formulario contenedor_panel_producto_admin">
                        <!--INFORME-->
                        <div class="contenedor_1_elementos_100">
                            <div class="contenedor_elemento_item">
                                <p class="estilo_nombre_input">Informe:
                                </p>
                                <div class="contenedor_subir_imagen_sola">
                                    @if ($editarInforme)
                                        <img src="{{ asset('imagenes/informe/con_foto_pdf.png') }}">
                                    @elseif($informe)
                                        <img src="{{ asset('imagenes/informe/con_foto_pdf.png') }}">
                                    @else
                                        <img src="{{ asset('imagenes/informe/sin_foto_pdf.png') }}">
                                    @endif
                                </div>
                                @if ($informe)
                                    <!--CONTENEDOR BOTONES-->
                                    <div class="contenedor_botones_admin">
                                        <a href="{{ Storage::url($venta->informes->first()->informe_ruta) }}"
                                            target="_blank">
                                            Descargar informe en ZIP <i class="fa-solid fa-file-zipper"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($observacion)
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
                    @endif
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

@push('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': true,
            'alwaysShowNavOnTouchDevices': true,
            'disableScrolling': false,
            'maxWidth': '80%',
            'maxHeight': '80%'
        })
    </script>
@endpush
