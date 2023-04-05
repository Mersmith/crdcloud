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
            <a href="{{ route('encargado.venta.sede.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            <button wire:click="$emit('eliminarVentaModal')">
                Eliminar venta <i class="fa-solid fa-trash-can"></i>
            </button>
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
                            @error('sede_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ODONTOLOGOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Odontólogos: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="odontologo_id" wire:change="actualizarOdontologo">
                                <option value="" selected disabled>Seleccione un odontólogo</option>
                                @foreach ($odontologos as $odontologoItem)
                                    <option value="{{ $odontologoItem->id }}">
                                        @if ($odontologoItem->ruc)
                                            {{ $odontologoItem->nombre_clinica . ' - ' . $odontologoItem->nombre . ' ' . $odontologoItem->apellido }}
                                        @else
                                            {{ $odontologoItem->nombre . ' ' . $odontologoItem->apellido }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('odontologo_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--PACIENTES-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Pacientes: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="paciente_id" wire:change="actualizarPaciente">
                                <option value="" selected disabled>Seleccione un paciente</option>
                                @foreach ($pacientes as $pacienteItem)
                                    <option value="{{ $pacienteItem->id }}">
                                        {{ $pacienteItem->nombre . ' ' . $pacienteItem->apellido }}</option>
                                @endforeach
                            </select>
                            @error('paciente_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!--SERVICIO-->
                <div class="formulario contenedor_panel_producto_admin">
                    <!--SERVICIOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Servicios: <span class="campo_opcional">(Opcional)</span>
                            </p>
                            <select wire:model="servicio_id">
                                <option value="" selected disabled>Seleccione un servicio</option>
                                @foreach ($servicios as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            @error('servicio_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ENVIAR-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_1_elementos">
                            <button wire:target="agregarServicioAlDetalleVenta"
                                wire:click="agregarServicioAlDetalleVenta">
                                Agregar servicio
                            </button>
                        </div>
                    </div>
                </div>

                <!--DATOS-->
                <div class="formulario contenedor_panel_producto_admin">

                    <!--LINK-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Link: <span class="campo_opcional">(Opcional)</span>
                            </p>
                            <input type="text" wire:model="link">
                            @error('link')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ESTADOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Estado de venta: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="estado" wire:change="actualizarEstado">
                                <option value="" selected disabled>Seleccione un estado</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Pagado</option>
                                <option value="3">Cancelado</option>
                            </select>
                            @error('estado')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
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
                                                {{ $servicios[$venta_detalle['servicio_id']] }}
                                                <br>
                                                <a
                                                    wire:click="eliminarUnDetalleVenta({{ $venta_detalle['id'] }}, {{ $index }})">
                                                    <span><i class="fa-solid fa-pencil"></i></span>
                                                    Eliminar</a>
                                            </td>
                                            <td style="text-align: center;">
                                                S/. {{ $venta_detalle['precio'] }}
                                            </td>
                                            <td style="text-align: center;">
                                                1
                                            </td>
                                            <td style="text-align: center;">
                                                S/.
                                                {{ number_format($venta_detalle['cantidad'] * $venta_detalle['precio']) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @php
                                    $total = array_reduce(
                                        $venta_detalles,
                                        function ($carry, $item) {
                                            return $carry + $item['cantidad'] * $item['precio'];
                                        },
                                        0,
                                    );
                                    $puntos = array_reduce(
                                        $venta_detalles,
                                        function ($carry, $item) {
                                            return $carry + $item['cantidad'] * $item['puntos'];
                                        },
                                        0,
                                    );
                                @endphp
                                <tfoot>
                                    <tr>
                                        <td style="text-align: right;" colspan="4">TOTAL:</td>
                                        <td style="text-align: center;">
                                            S/. {{ number_format($total) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;" colspan="4">PUNTOS A GANAR:</td>
                                        <td style="text-align: center;">
                                            {{ $puntos }}
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>

                    <!--DROPZONE IMAGEN-->
                    <div class="contenedor_panel_producto_admin">
                        <div class="contenedor_elemento_formulario" wire:ignore>
                            <form action="{{ route('encargado.venta.sede.dropzone', $venta) }}" method="POST"
                                class="dropzone" id="my-awesome-dropzone"></form>
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

                    <!--DROPZONE INFORME-->
                    <div class="contenedor_panel_producto_admin">
                        <div class="contenedor_elemento_formulario" wire:ignore>
                            <form action="{{ route('encargado.venta.sede.dropzone.zip', $venta) }}" method="POST"
                                class="dropzone" id="my-zip-dropzone"></form>
                        </div>
                    </div>
                    <!--INFORME-->
                    <div class="contenedor_panel_producto_admin">
                        @if ($venta->informes->count())
                            <div class="formulario">
                                <!--INFORME-->
                                <div class="contenedor_1_elementos_100">
                                    <div class="contenedor_elemento_item">
                                        <p class="estilo_nombre_input">Informe: <span
                                                class="campo_opcional">(Opcional)</span>
                                        </p>
                                        <div class="contenedor_subir_imagen_sola">
                                            <img src="{{ asset('imagenes/informe/con_foto_pdf.png') }}">
                                            <span class="boton_imagen_borrar" wire:click="eliminarInforme()"
                                                wire:loading.attr="disabled" wire:target="eliminarInforme()">
                                                <i class="fa-solid fa-trash"></i>
                                            </span>
                                        </div>
                                        <a href="{{ Storage::url($venta->informes->first()->informe_ruta) }}"
                                            target="_blank">
                                            <i class="fa-solid fa-file"></i>
                                            Ver informe
                                        </a>
                                        @error('editarInforme')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

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
                        <button class="boton_suelto" wire:loading.attr="disabled" wire:target="actualizarVenta"
                            wire:click="actualizarVenta">
                            Actualizar venta
                        </button>
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

@push('script')
    <script>
        let mensajeDropZone =
            "<div class='mensaje_dropzone'><i class='fa-solid fa-cloud-arrow-up'></i><span>Suelte las imagenes aquí o haga clic para subir.</span></div>";

        Dropzone.options.myAwesomeDropzone = {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: mensajeDropZone,
            acceptedFiles: 'image/*',
            paramName: "nuevaImagen",
            maxFilesize: 2,
            complete: function(nuevaImagen) {
                this.removeFile(nuevaImagen);
            },
            queuecomplete: function() {
                Livewire.emit('dropImagenes');
            }
        };

        let mensajeZipDropZone =
            "<div class='mensaje_dropzone'><i class='fa-solid fa-cloud-arrow-up'></i><span>Suelte el informe en zip aquí o haga clic para subir.</span></div>";

        Dropzone.options.myZipDropzone = {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: mensajeZipDropZone,
            acceptedFiles: '.zip',
            paramName: "nuevoZip",
            maxFilesize: 10,
            complete: function(nuevoZip) {
                this.removeFile(nuevoZip);
            },
            queuecomplete: function() {
                Livewire.emit('dropZip');
            }
        };

        Livewire.on('eliminarVentaModal', () => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recuparlo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('encargado.venta-sede.venta-sede-editar-livewire',
                        'eliminarVenta');
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
