<div>
    <!--SEO-->
    @section('tituloPagina', 'Crear canjeo')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar canjeo</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('odontologo.canjeo.odontologo.index') }}">
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
                                <span style="color: #189bb6; font-size: 26px;">{{ $puntos }}</span>
                                <img style="height: 24px;" src="{{ asset('imagenes/empresa/crd-puntos.png') }}"
                                    alt="" />
                            </div>
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
                                @foreach ($servicios as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            @error('servicio')
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
                            <button wire:target="agregarServicioAlDetalleCanjeo"
                                wire:click="agregarServicioAlDetalleCanjeo">
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
                            <input type="text" wire:model="dni">
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
                            @if (count($canjeo_detalles) > 0)
                                <!--CUERPO-->
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
                                                <input type="number" style="width: 75px;"
                                                    wire:model="canjeo_detalles.{{ $index }}.cantidad"
                                                    wire:change="actualizarCantidad({{ $canjeo_detalle['id'] }}, $event.target.value)">

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
                @if (count($canjeo_detalles) > 0)
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
                        <button class="boton_suelto" wire:loading.attr="disabled" wire:target="actualizarCanjeo"
                            wire:click="actualizarCanjeo">
                            Actualizar canjeo
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
</div>

@push('script')
    <script>
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
                    Livewire.emitTo('odontologo.canjeo-odontologo.canjeo-odontologo-editar-livewire',
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
