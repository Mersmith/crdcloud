<div>
    <!--SEO-->
    @section('tituloPagina', 'Ventas')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Ventas</h2>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--GRID VENTAS-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="grid_estado_orden">
                <div class="grid_estado_0 estilo_estado_orden" style="background-color: #189bb6;">
                    <a href="{{ route('encargado.venta.sede.index') }}">
                        <p class="text-center text-2xl">
                            {{ $todos }}
                        </p>
                        <p class="uppercase text-center">Todos</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_1 estilo_estado_orden" style="background-color: rgb(245, 171, 11);">
                    <a href="{{ route('encargado.venta.sede.index') . '?estado=1' }}">
                        <p class="text-center text-2xl">
                            {{ $pendiente }}
                        </p>
                        <p class="uppercase text-center">Falta Pagar</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fas fa-business-time"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_2 estilo_estado_orden" style="background-color: rgb(13, 235, 87);">
                    <a href="{{ route('encargado.venta.sede.index') . '?estado=2' }}">
                        <p class="text-center text-2xl">
                            {{ $pagado }}
                        </p>
                        <p class="uppercase text-center">Pagado</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_3 estilo_estado_orden" style="background-color: rgb(243, 57, 10);">
                    <a href="{{ route('encargado.venta.sede.index') . '?estado=3' }}">
                        <p class="text-center text-2xl">
                            {{ $anulado }}
                        </p>
                        <p class="uppercase text-center">Anulado</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fas fa-times-circle"></i>
                        </p>
                    </a>
                </div>
            </div>
        </div>

        <!--BUSCADOR-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="contenedor_elemento_item">
                <p class="estilo_nombre_input">Buscar venta: <span class="campo_opcional">(Opcional)</span> </p>
                <input type="text" wire:model="buscarNumeroDeVenta"
                    placeholder="Ingrese el número de venta o datos del paciente.">
            </div>
        </div>

        <!--TABLA-->
        <div class="contenedor_panel_producto_admin">
            @if ($ventas->count())

                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista</h3>
                </div>

                <!--CONTENEDOR BOTONES-->
                <div class="contenedor_botones_admin">
                    <button>
                        PDF <i class="fa-solid fa-file-pdf"></i>
                    </button>
                    <button>
                        EXCEL <i class="fa-regular fa-file-excel"></i>
                    </button>
                    <button onClick="window.scrollTo(0, document.body.scrollHeight);">
                        Abajo <i class="fa-solid fa-arrow-down"></i>
                    </button>
                </div>

                <!--TABLA-->
                <div class="tabla_administrador py-4 overflow-x-auto">
                    <div class="inline-block min-w-full overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th>
                                        N° Orden</th>
                                    <th>
                                        Paciente</th>
                                    <th>
                                        Exámen</th>
                                    <th>
                                        Estado</th>
                                    <th>
                                        Link</th>
                                    <th>
                                        Descarga</th>
                                    <th>
                                        Registro</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $ventaItem)
                                    <tr>
                                        <td style="text-align: center;">
                                            {{ $ventaItem->id }}
                                        </td>
                                        <td>
                                            {{ $ventaItem->nombre_paciente . ' ' . $ventaItem->apellido_paciente }}
                                        </td>
                                        <td>
                                            {{ $ventaItem->nombre }}
                                        </td>
                                        <td style="text-align: center;">
                                            @switch($ventaItem->estado)
                                                @case(1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(245, 171, 11);">
                                                        Pendiente
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(13, 235, 87);">
                                                        Pagado
                                                    </span>
                                                @break

                                                @case(3)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(243, 57, 10);">
                                                        Anulado
                                                    </span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($ventaItem->link)
                                                <a href="{{ $ventaItem->link }}" target="_blank"><i
                                                        class="fa-brands fa-google-drive"></i></a>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            @if ($ventaItem->link)
                                                {{ $ventaItem->descargas_imagen }}
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $ventaItem->created_at }}
                                        </td>
                                        <td style="text-align: center;">
                                            <a class="tabla_editar"
                                                href="{{ route('encargado.venta.sede.editar', $ventaItem->id) }}">
                                                <i class="fa-solid fa-pencil"></i></a>
                                            <i wire:click="compartir({{ $ventaItem->id }})"
                                                class="fa-solid fa-share-nodes"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($ventas->hasPages())
                    <div>
                        {{ $ventas->links('pagination::tailwind') }}
                    </div>
                @endif
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay ventas</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>
    </div>

    <!--MODAL-->
    @if ($url)
        <!--CONTENEDOR MODAL-->
        <x-dialog-modal wire:model="abrir_modal">
            <!--TITULO-->
            <x-slot name="title">
                <div class="contenedor_titulo_modal">
                    <!--ENCABEZADO-->
                    <div>
                        <h2 style="font-weight: bold">Compartir link</h2>
                    </div>

                    <!--CERRAR-->
                    <div>
                        <button wire:click="$set('abrir_modal', false)" wire:loading.attr="disabled">
                            <i style="cursor: pointer; color: #666666;" class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </x-slot>
            <!--CONTENIDO-->
            <x-slot name="content">
                <div class="formulario">
                    <p style="word-wrap: break-word;">{{ $url }}</p>
                </div>
            </x-slot>
            <x-slot name="footer">
                <div class="contenedor_pie_modal" x-data="{ url: '' }" x-init="url = '{{ $url }}'">
                    <button style="background-color: #181C32;" wire:click="$set('abrir_modal', false)"
                        wire:loading.attr="disabled" type="submit"><i class="fa-solid fa-xmark"></i> Cancelar</button>

                    <button
                        x-on:click="
                    navigator.clipboard.writeText(url);
                    $dispatch('alert', {type: 'success', message: 'Enlace copiado al portapapeles'})
                "
                        style="background-color: #189bb6;" type="submit">Copiar <i class="fa-solid fa-clipboard"></i></button>
                </div>
            </x-slot>
        </x-dialog-modal>
    @endif

</div>
