<div>
    <!--SEO-->
    @section('tituloPagina', 'Editar venta')

    <div>
        <h1>Editar Venta</h1>

        <form wire:submit.prevent="actualizarVenta">
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" wire:model="venta.estado">
                <option value="1">Pendiente</option>
                <option value="2">Pagado</option>
                <option value="3">Cancelado</option>
            </select>

            <button type="submit">Actualizar</button>
        </form>

        <form wire:submit.prevent="agregarServicioAlDetalleVenta">
            <div class="form-group">
                <label for="nuevo_servicio_id">Servicio:</label>
                <select class="form-control" wire:model="nuevo_servicio_id">
                    <option value="">Seleccione un servicio</option>
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
                @error('nuevo_servicio_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="nueva_cantidad">Cantidad:</label>
                <input type="number" class="form-control" wire:model="nueva_cantidad">
                @error('nueva_cantidad')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>

        <button type="button" wire:click="actualizarTotal">Actualizar total
        </button>

        <table>
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta_detalles as $index => $venta_detalle)
                    <tr>
                        <td>
                            <select id="servicio{{ $index }}" name="servicio"
                                wire:model="venta_detalles.{{ $index }}.servicio_id">
                                @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td><input type="number" class="form-control"
                                wire:model="venta_detalles.{{ $index }}.cantidad"></td>

                        <td><input type="number" id="precio{{ $index }}" name="precio"
                                wire:model="venta_detalles.{{ $index }}.precio" min="0"></td>

                        <td>{{ $venta_detalle['cantidad'] * $venta_detalle['precio'] }}</td>

                        <td>
                            <button class="btn btn-primary"
                                wire:click="actualizarDetalleVenta({{ $venta_detalle['id'] }}, {{ $venta_detalle['cantidad'] }})">Actualizar
                            </button>
                            <button type="button"
                                wire:click="eliminarUnDetalleVenta({{ $venta_detalle['id'] }})">Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $total = array_reduce(
                $venta_detalles,
                function ($carry, $item) {
                    return $carry + $item['cantidad'] * $item['precio'];
                },
                0,
            );

        @endphp

        <p>Total: {{$total }}</p>
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
                    Livewire.emitTo('administrador.venta.venta-editar-livewire',
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
                    Livewire.emitTo('administrador.venta.venta-editar-livewire',
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
