<div>
    <!--SEO-->
    @section('tituloPagina', 'Editar canjeo')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar canjeo</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.canjeo.index') }}">
                <i class="fa-solid fa-arrow-left"></i> Regresar</a>
            <button wire:click="$emit('eliminarCanjeoModal')">
                Eliminar canjeo <i class="fa-solid fa-trash-can"></i>
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

                    <!--MIS PUNTOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Mis puntos:</p>
                            <div style="display: flex; align-items: center;">
                                <span style="color: #189bb6; font-size: 26px;">{{ $odontologo->puntos }}</span>
                                <img style="height: 24px;" src="{{ asset('imagenes/empresa/crd-puntos.png') }}"
                                    alt="" />
                            </div>
                        </div>
                    </div>

                    <!--ODONTOLOGOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Odontólogo:
                            </p>
                            <a href="{{ route('administrador.odontologo.informacion', $odontologo->id) }}"
                                target="_blank"
                                style="max-width: 100%; display: inline-block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><i
                                    class="fa-solid fa-user-injured"></i>
                                {{ $odontologo->nombre . ' ' . $odontologo->apellido }}</a>
                        </div>
                    </div>

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

                   <!--DATOS-->
                   <div class="formulario contenedor_panel_producto_admin">
                    <!--NOMBRE-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Nombre: <span class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="text" value="{{ $canjeo->nombre }}" disabled>
                        </div>
                    </div>
                    <!--APELLIDO-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Apellido: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="text" value="{{ $canjeo->apellido }}" disabled>
                        </div>
                    </div>
                    <!--DNI-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">DNI: <span class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="text" value="{{ $canjeo->dni }}" disabled>
                        </div>
                    </div>
                </div>

                <!--SERVICIO-->
                <div class="formulario contenedor_panel_producto_admin">
                    <!--SERVICIOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Servicios: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="servicio">
                                <option value="" selected disabled>Seleccione un servicio</option>
                                @foreach ($servicios as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
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
                            <button wire:target="agregarServicioAlDetalleCanjeo"
                                wire:click="agregarServicioAlDetalleCanjeo">
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

                @if ($canjeo_detalles)

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
                                        SubTotal Puntos</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($canjeo_detalles as $index => $canjeo_detalle)
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $servicios[$canjeo_detalle['servicio_id']] }}
                                                <br>
                                                <a
                                                    wire:click="eliminarUnDetalleCanjeo({{ $canjeo_detalle['id'] }}, {{ $index }})">
                                                    <span><i class="fa-solid fa-pencil"></i></span>
                                                    Eliminar</a>
                                            </td>
                                            <td style="text-align: center;">
                                                {{ $canjeo_detalle['puntos'] }}
                                            </td>
                                            <td style="text-align: center;">
                                                1
                                            </td>
                                            <td style="text-align: center;">
                                                {{ $canjeo_detalle['cantidad'] * $canjeo_detalle['puntos'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @php
                                    $total = array_reduce(
                                        $canjeo_detalles,
                                        function ($carry, $item) {
                                            return $carry + $item['cantidad'] * $item['puntos'];
                                        },
                                        0,
                                    );
                                @endphp
                                <tfoot>
                                    <tr>
                                        <td style="text-align: right;" colspan="4">TOTAL PUNTOS:</td>
                                        <td style="text-align: center;">
                                            {{ $total }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!--DROPZONE IMAGEN-->
                    <div class="contenedor_panel_producto_admin">
                        <div class="contenedor_elemento_formulario" wire:ignore>
                            <form action="{{ route('encargado.canjeo.sede.dropzone', $canjeo) }}" method="POST"
                                class="dropzone" id="my-awesome-dropzone"></form>
                        </div>
                    </div>
                    <!--IMAGENES-->
                    <div class="contenedor_panel_producto_admin">
                        @if ($canjeo->imagenesCanjeo->count())
                            <div class="contenedor_1_elementos_imagen">
                                <div class="contenedor_imagenes_subidas_dropzone" id="sortableimagenes">
                                    @foreach ($canjeo->imagenesCanjeo->sortBy('posicion') as $key => $imagen)
                                        <div wire:key="imagen-{{ $imagen->id }}" data-id="{{ $imagen->id }}">
                                            <img class="handle2 cursor-grab"
                                                src="{{ Storage::url($imagen->imagen_canjeo_ruta) }}" alt="">
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
                            <form action="{{ route('encargado.canjeo.sede.dropzone.zip', $canjeo) }}" method="POST"
                                class="dropzone" id="my-zip-dropzone"></form>
                        </div>
                    </div>
                    <!--INFORME-->
                    <div class="contenedor_panel_producto_admin">
                        @if ($canjeo->informesCanjeo->count())
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
                                        <a href="{{ Storage::url($canjeo->informesCanjeo->first()->informe_canjeo_ruta) }}"
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
                    Livewire.emitTo('encargado.canjeo-sede.canjeo-sede-editar-livewire',
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
