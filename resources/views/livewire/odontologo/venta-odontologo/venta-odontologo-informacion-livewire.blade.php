<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontólogo - Información del Exámen')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Información del exámen</h2>
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
                                    <input type="text" value="Anulado" disabled>
                                @break

                                @default
                            @endswitch
                        </div>
                    </div>

                    <!--SEDES-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Sede CRD:</p>
                            <input type="text" value="{{ $sede->nombre }}" disabled>
                        </div>
                    </div>

                    <!--PACIENTES-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Paciente:</p>
                            <a href="{{ route('odontologo.paciente.odontologo.informacion', $paciente->id) }}"
                                target="_blank"
                                style="max-width: 100%; display: inline-block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><i
                                    class="fa-solid fa-user-injured"></i>
                                {{ $paciente->nombre . ' ' . $paciente->apellido }}</a>
                        </div>
                    </div>
                </div>

                <!--DESCARGAS-->
                <div class="formulario contenedor_panel_producto_admin">
                    <!--IMAGEN-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Cantidad descarga de imagenes:</p>
                            <input type="text" value="{{ $venta->descargas_imagen }}" disabled>
                        </div>
                    </div>

                    <!--INFORME-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Cantidad descarga de informes:</p>
                            <input type="text" value="{{ $venta->descargas_informe }}" disabled>
                        </div>
                    </div>

                    <!--LINK-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Cantidad descarga de drive:</p>
                            <input type="text" value="{{ $venta->descargas_link }}" disabled>
                        </div>
                    </div>

                    <!--VISTAS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Cantidad vistas de imagen:</p>
                            <input type="text" value="{{ $venta->vistas_imagen }}" disabled>
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
                                        Exámen</th>
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
                                                {{ $servicios[$venta_detalle['servicio_id']] }}
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
                    @if ($venta->imagenes->count())
                        <div class="contenedor_panel_producto_admin">
                            <!--CONTENEDOR SUBTITULO-->
                            <p class="estilo_nombre_input">Imágenes:
                            </p>
                            <div class="contenedor_1_elementos_imagen">
                                <div class="contenedor_imagenes_subidas_dropzone" id="sortableimagenes">
                                    @foreach ($venta->imagenes as $key => $imagen)
                                        <div>
                                            <a href="{{ Storage::url($imagen->imagen_ruta) }}" data-lightbox="gallery">
                                                <img src="{{ Storage::url($imagen->imagen_ruta) }}" alt="" wire:click="aumentarVistas()">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <!--CONTENEDOR BOTONES-->
                                <div class="contenedor_botones_admin">
                                    <button wire:click="descargarImagenes()">
                                        <i class="fa-solid fa-file-zipper"></i> Descargar imagenes en ZIP
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!--INFORME-->
                    @if ($informe)
                        <div class="formulario contenedor_panel_producto_admin">
                            <!--INFORME-->
                            <div class="contenedor_1_elementos_100">
                                <div class="contenedor_elemento_item">
                                    <p class="estilo_nombre_input">Informe:
                                    </p>
                                    <div class="contenedor_subir_imagen_sola">
                                        <img src="{{ asset('imagenes/informe/con_foto_pdf.png') }}">
                                    </div>
                                    <!--CONTENEDOR BOTONES-->
                                    <div class="contenedor_botones_admin">
                                        <a wire:click="descargarInforme()" style="cursor: pointer;">
                                            <i class="fa-solid fa-file-zipper"></i> Descargar informe en ZIP
                                        </a>
                                        {{-- <a href="{{ Storage::url($venta->informes->first()->informe_ruta) }}"
                                            target="_blank">
                                            <i class="fa-solid fa-file-zipper"></i> Descargar informe en ZIP
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!--LINK-->
                    @if ($link)
                        <div class="formulario contenedor_panel_producto_admin">
                            <!--LINK-->
                            <div class="contenedor_1_elementos_100">
                                <div class="contenedor_elemento_item">
                                    <p class="estilo_nombre_input">Link:</p>
                                    {{-- <a href="{{ $link }}" target="_blank"
                                        style="max-width: 100%; display: inline-block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><i
                                            class="fa-brands fa-google-drive"></i> {{ $link }}</a> --}}
                                </div>
                            </div>
                            <!--CONTENEDOR BOTONES-->
                            <div class="contenedor_botones_admin">
                                <a wire:click="abrirLink()" style="cursor: pointer;">
                                    <i class="fa-brands fa-google-drive"></i> Abrir link en DRIVE
                                </a>
                                {{-- <a href="{{ $link }}" target="_blank">
                                    <i class="fa-brands fa-google-drive"></i> Descargar informe en DRIVE
                                </a> --}}
                            </div>

                        </div>
                    @endif

                    <!--OBSERVACIÓN-->
                    @if ($observacion)
                        <div class="formulario contenedor_panel_producto_admin">
                            <!--OBSERVACIÓN-->
                            <div class="contenedor_1_elementos_100">
                                <div class="contenedor_elemento_item">
                                    <p class="estilo_nombre_input">Observación:</p>
                                    <textarea rows="3" disabled>{{ $observacion }}</textarea>
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
        });

        Livewire.on('abrirLink', function (data) {
            window.open(data.link, '_blank');
        });
    </script>
@endpush
