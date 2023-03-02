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

                    <!--ODONTOLOGOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Odontólogos: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="odontologo_id">
                                <option value="" selected disabled>Seleccione un odontólogo</option>
                                @foreach ($odontologos as $odontologoItem)
                                    <option value="{{ $odontologoItem->id }}">
                                        {{ $odontologoItem->nombre . ' ' . $odontologoItem->apellido }}</option>
                                @endforeach
                            </select>
                            @error('odontologo_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!--CLINICAS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Clínicas: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="clinica_id">
                                <option value="" selected disabled>Seleccione una clínica</option>
                                @foreach ($clinicas as $clinicaItem)
                                    <option value="{{ $clinicaItem->id }}">
                                        {{ $clinicaItem->nombre_clinica . ' - ' . $clinicaItem->nombre . ' ' . $clinicaItem->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            @error('clinica_id')
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
                            <select wire:model="paciente_id">
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

                    <!--SERVICIOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Servicios: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <select wire:model="servicio_id">
                                <option value="" selected disabled>Seleccione un servicio</option>
                                @foreach ($servicios as $servicioItem)
                                    <option value="{{ $servicioItem->id }}">{{ $servicioItem->nombre }}</option>
                                @endforeach
                            </select>
                            @error('servicio_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--CANTIDAD-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Cantidad: <span
                                    class="campo_obligatorio">(Obligatorio)</span>
                            </p>
                            <input type="number" wire:model="cantidad">
                            @error('cantidad')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ENVIAR-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_1_elementos">
                            <button wire:target="agregarCarrito" wire:click="agregarServicioAlDetalleCanjeo">
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
                            <p class="estilo_nombre_input">Link: <span class="campo_obligatorio">(Obligatorio)</span>
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
                            <select wire:model="estado">
                                <option value="" selected disabled>Seleccione un estado</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Aplicado</option>
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
                                        Puntos</th>
                                    <th>
                                        Cantidad</th>
                                    <th>
                                        SubTotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($canjeo_detalles as $index => $canjeo_detalle)
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $servicios[$canjeo_detalle['servicio_id']]->nombre }}
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
                                                <input type="number" style="width: 75px;"
                                                    wire:model="canjeo_detalles.{{ $index }}.cantidad"
                                                    wire:change="actualizarCantidad({{ $canjeo_detalle['id'] }}, $event.target.value)">

                                            </td>
                                            <td style="text-align: center;">
                                                {{ $canjeo_detalle['cantidad'] * $canjeo_detalle['puntos'] }}
                                            </td>
                                            {{-- <td>
                                                <button class="btn btn-primary"
                                                    wire:click="actualizarCantidad({{ $canjeo_detalle['id'] }}, {{ $canjeo_detalle['cantidad'] }})">Actualizar
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    @php
                                        $total = array_reduce(
                                            $canjeo_detalles,
                                            function ($carry, $item) {
                                                return $carry + $item['cantidad'] * $item['puntos'];
                                            },
                                            0,
                                        );
                                    @endphp
                                    <tr>
                                        <td style="text-align: right;" colspan="4">TOTAL:</td>
                                        <td style="text-align: center;">
                                            {{ number_format($total) }}
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>

                    <!--Dropzone-->
                    <div class="contenedor_panel_producto_admin">
                        <div class="contenedor_elemento_formulario" wire:ignore>
                            <form action="{{ route('administrador.canjeo.dropzone', $canjeo) }}" method="POST"
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
                                    <a href="{{ Storage::url($canjeo->informesCanjeo->first()->informe_canjeo_ruta) }}"
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
                                <p class="estilo_nombre_input">Observación: <span
                                        class="campo_obligatorio">(Obligatorio)</span>
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
                        <button class="boton_suelto" wire:loading.attr="disabled" wire:target="actualizarCanjeo"
                            wire:click="actualizarCanjeo">
                            Actualizar canjeo
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
        new Sortable(sortableimagenes, {
            handle: '.handle2',
            animation: 150,
            ghostClass: 'bg-blue-100',
            store: {
                set: function(sortable) {
                    const sorts = sortable.toArray();
                    //console.log(sorts);
                    Livewire.emitTo('administrador.canjeo.canjeo-editar-livewire',
                        'cambiarPosicionImagenes', sorts);
                },
                onStart: function(evt) {
                    console.log(evt.oldIndex);
                },
            }
        });

        let mensajeDropZone =
            "<div class='mensaje_dropzone'><i class='fa-solid fa-cloud-arrow-up'></i><span>Suelte las imagenes aquí o haga clic para subir.</span></div>";

        Dropzone.options.myAwesomeDropzone = {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dictDefaultMessage: mensajeDropZone,
            acceptedFiles: 'image/*',
            paramName: "file",
            maxFilesize: 2,
            complete: function(file) {
                this.removeFile(file);
            },
            queuecomplete: function() {
                Livewire.emit('dropImagenes');
            }
        };

        Livewire.on('eliminarCanjeoModal', () => {
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
                    Livewire.emitTo('administrador.canjeo.canjeo-editar-livewire',
                        'eliminarCanjeo');
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
