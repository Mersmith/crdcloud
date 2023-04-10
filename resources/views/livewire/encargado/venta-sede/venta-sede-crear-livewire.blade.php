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
            <a href="{{ route('encargado.venta.sede.index') }}">
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
                    <!--FILTRAR POR SEDE-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <label class="estilo_nombre_input">¿Filtrar por tu sede?: </label>
                            <input type="checkbox" wire:model="filtrar_sede">
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

                    <!--ODONTÓLOGOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Odontólogos: <span
                                    class="campo_obligatorio">(Obligatorio)</span></p>
                            <div x-data="{ open: false }" class="relative">
                                <input type="text" wire:model="buscarOdontologo" placeholder="Buscar odontólogo..."
                                    x-on:click.prevent="open = !open" x-on:keydown.escape="open = false">
                                <div x-cloak x-show="open" class="select_contenedor_buscador"
                                    x-on:click.away="open = false" x-init="document.addEventListener('click', function(event) { if (!event.target.closest('.relative')) { open = false; } })">
                                    <div class="select_buscador_item_no_seleccionado">Seleccione un odontólogo</div>
                                    @foreach ($odontologos as $key => $odontologo)
                                        @if (strpos(strtolower($odontologo->nombre . ' ' . $odontologo->apellido), strtolower($buscarOdontologo)) !== false ||
                                                strpos(strtolower($odontologo->nombre . ' ' . $odontologo->apellido), strtolower($buscarOdontologo)) !== false)
                                            <div wire:click="$set('odontologo_id', {{ $odontologo->id }}); open = false;"
                                                x-on:click="open = false"
                                                class="select_buscador_item @if ($key == count($odontologos) - 1) border-b-0 @endif">
                                                {{ $odontologo->nombre . ' ' . $odontologo->apellido }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @error('odontologo_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--CLINICAS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Clínicas: <span
                                    class="campo_obligatorio">(Obligatorio)</span></p>
                            <div x-data="{ open: false }" class="relative">
                                <input type="text" wire:model="buscarClinica" placeholder="Buscar clínica..."
                                    x-on:click.prevent="open = !open" x-on:keydown.escape="open = false">
                                <div x-cloak x-show="open" class="select_contenedor_buscador"
                                    x-on:click.away="open = false" x-init="document.addEventListener('click', function(event) { if (!event.target.closest('.relative')) { open = false; } })">
                                    <div class="select_buscador_item_no_seleccionado">Seleccione una clínica</div>
                                    @foreach ($clinicas as $key => $clinicaItem)
                                        @if (strpos(strtolower($clinicaItem->nombre . ' ' . $clinicaItem->apellido), strtolower($buscarClinica)) !== false ||
                                                strpos(strtolower($clinicaItem->nombre . ' ' . $clinicaItem->apellido), strtolower($buscarClinica)) !== false)
                                            <div wire:click="$set('clinica_id', {{ $clinicaItem->id }}); open = false;"
                                                x-on:click="open = false"
                                                class="select_buscador_item @if ($key == count($clinicas) - 1) border-b-0 @endif">
                                                {{ $clinicaItem->nombre_clinica . ' - ' . $clinicaItem->nombre . ' ' . $clinicaItem->apellido }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @error('clinica_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--PACIENTES-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Pacientes: <span
                                    class="campo_obligatorio">(Obligatorio)</span></p>
                            <div x-data="{ open: false }" class="relative">
                                <input type="text" wire:model="buscarPaciente" placeholder="Buscar paciente..."
                                    x-on:click.prevent="open = !open" x-on:keydown.escape="open = false">
                                <div x-cloak x-show="open" class="select_contenedor_buscador"
                                    x-on:click.away="open = false" x-init="document.addEventListener('click', function(event) { if (!event.target.closest('.relative')) { open = false; } })">
                                    <div class="select_buscador_item_no_seleccionado">Seleccione un paciente</div>
                                    @foreach ($pacientes as $key => $pacienteItem)
                                        @if (strpos(strtolower($pacienteItem->nombre . ' ' . $pacienteItem->apellido), strtolower($buscarPaciente)) !== false ||
                                                strpos(strtolower($pacienteItem->nombre . ' ' . $pacienteItem->apellido), strtolower($buscarPaciente)) !==
                                                    false)
                                            <div wire:click="$set('buscarPaciente', '{{ $pacienteItem->nombre . ' ' . $pacienteItem->apellido }}');"
                                                wire:click.defer="$set('paciente_id', {{ $pacienteItem->id }}); open = false;"
                                                x-on:click="open = false"
                                                class="select_buscador_item @if ($key == count($pacientes) - 1) border-b-0 @endif">
                                                {{ $pacienteItem->nombre . ' ' . $pacienteItem->apellido }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @error('paciente_id')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--SERVICIOS-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Servicios: <span
                                    class="campo_obligatorio">(Obligatorio)</span></p>
                            <div x-data="{ open: false }" class="relative">
                                <input type="text" wire:model="buscarServicio" placeholder="Buscar servicio..."
                                    x-on:click.prevent="open = !open" x-on:keydown.escape="open = false">
                                <div x-cloak x-show="open" class="select_contenedor_buscador"
                                    x-on:click.away="open = false" x-init="document.addEventListener('click', function(event) { if (!event.target.closest('.relative')) { open = false; } })">
                                    <div class="select_buscador_item_no_seleccionado">Seleccione un servicio</div>
                                    @foreach ($servicios as $key => $servicioItem)
                                        @if (strpos(strtolower($servicioItem->nombre), strtolower($buscarServicio)) !== false ||
                                                strpos(strtolower($servicioItem->nombre), strtolower($buscarServicio)) !== false)
                                            <div wire:click="$set('buscarServicio', '{{ $servicioItem->nombre }}');"
                                                wire:click.defer="$set('servicio', {{ $servicioItem }}); open = false;"
                                                x-on:click="open = false"
                                                class="select_buscador_item @if ($key == count($servicios) - 1) border-b-0 @endif">
                                                {{ $servicioItem->nombre }}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
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
                            <select wire:model="estado">
                                <option value="" selected disabled>Seleccione un estado</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Pagado</option>
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
                                        Servicio</th>
                                    <th>
                                        Precio</th>
                                    <th>
                                        Cantidad</th>
                                    <th>
                                        SubTotal</th>
                                </tr>
                            </thead>

                            @if (count($carrito) > 0)
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
                                                S/. {{ number_format($carritoItem['precio'], 2, '.', ',') }}
                                            </td>
                                            <td style="text-align: center;">
                                                {{ $carritoItem['cantidad'] }}
                                            </td>
                                            <td style="text-align: center;">
                                                S/.
                                                {{ number_format($carritoItem['subtotal_compra'], 2, '.', ',') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @php
                                    $total = array_sum(array_column($carrito, 'subtotal_compra'));
                                    $totalPuntos = array_sum(array_column($carrito, 'subtotal_puntos'));
                                @endphp
                                <tfoot>
                                    <tr>
                                        <td style="text-align: right;" colspan="4">TOTAL:</td>
                                        <td style="text-align: center;">
                                            S/. {{ number_format($total, 2, '.', ',') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;" colspan="4">PUNTOS A GANAR:</td>
                                        <td style="text-align: center;">
                                            {{ $totalPuntos }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif

                        </table>
                    </div>
                </div>


                @if (count($carrito) > 0)
                    <!--IMAGENES-->
                    <div class="formulario contenedor_panel_producto_admin">
                        <!--IMAGENES-->
                        <div class="contenedor_1_elementos_100">
                            <div class="contenedor_elemento_item">
                                <p class="estilo_nombre_input">Imagenes: <span
                                        class="campo_obligatorio">(Obligatorio)</span>
                                </p>
                                <div class="contenedor_subir_imagen_sola">
                                    <img src="{{ asset('imagenes/radiografia/sin_foto_radiografia.png') }}">
                                    <div class="opcion_cambiar_imagen">
                                        <label for="imagenes">
                                            <div style="cursor: pointer;">
                                                Subir <i class="fa-solid fa-camera"></i>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <input type="file" wire:model="imagenes" multiple style="display: none"
                                    id="imagenes" accept="image/jpeg">
                                @error('imagenes')
                                    <span class="campo_obligatorio">{{ $message }} </span>
                                @enderror
                            </div>
                        </div>

                        <!--Imagenes-->
                        @if ($imagenes)
                            <div class="contenedor_1_elementos_imagen">
                                <div class="contenedor_imagenes_subidas_dropzone">
                                    @foreach ($imagenes as $key => $imagen)
                                        <div wire:key="{{ $loop->index }}" data-id="{{ $key }}">
                                            <img class="handle2 cursor-grab" src="{{ $imagen->temporaryUrl() }}">
                                            <span class="imagen_dropzone_eliminar"
                                                wire:click="eliminarImagen({{ $loop->index }})">
                                                <i class="fa-solid fa-xmark"style="color: white;"></i>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!--INFORME-->
                    <div class="formulario contenedor_panel_producto_admin">
                        <div class="contenedor_1_elementos_100">
                            <div class="contenedor_elemento_item">
                                <p class="estilo_nombre_input">Informe: <span class="campo_opcional">(Opcional)</span>
                                </p>
                                <div class="contenedor_subir_imagen_sola">
                                    @if ($informe)
                                        <img src="{{ asset('imagenes/informe/con_foto_pdf.png') }}">
                                        <span class="boton_imagen_eliminar" wire:click="$set('informe', null)">
                                            <i class="fa-solid fa-xmark"></i>
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
                                <input type="file" wire:model="informe" style="display: none" id="informeSubir"
                                    accept=".zip">
                                @error('informe')
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
                            Crear venta
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
