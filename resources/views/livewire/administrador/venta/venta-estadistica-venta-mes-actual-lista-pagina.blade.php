<div>
    <!--SEO-->
    @section('tituloPagina', 'Ventas')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Ventas mes actual</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.sede.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('administrador.venta.estadistica.venta.mes.actual.cantidad') }}">
                Ventas mes actual cantidad <i class="fa-solid fa-eye"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--GRID VENTAS-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="grid_estado_orden">
                <div class="grid_estado_0 estilo_estado_orden" style="background-color: rgb(35, 32, 226);">
                    <a href="{{ route('administrador.venta.estadistica.venta.mes.actual.lista') }}">
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
                    <a href="{{ route('administrador.venta.estadistica.venta.mes.actual.lista') . '?estado=1' }}">
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
                    <a href="{{ route('administrador.venta.estadistica.venta.mes.actual.lista') . '?estado=2' }}">
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
                    <a href="{{ route('administrador.venta.estadistica.venta.mes.actual.lista') . '?estado=3' }}">
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
                <input type="text" wire:model="buscarNumeroDeVenta" placeholder="Ingrese el número de venta.">
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
                                        Estado</th>
                                    <th>
                                        Total</th>
                                    <th>
                                        Registro</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $ventaItem)
                                    <tr style="text-align: center;">
                                        <td>
                                            N° 00000-{{ $ventaItem->id }}
                                        </td>
                                        <td>
                                            @switch($ventaItem->estado)
                                                @case(1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(245, 171, 11);">
                                                        Falta Pagar
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
                                        <td>
                                            S/. {{ $ventaItem->total }}
                                        </td>
                                        <td>
                                            {{ $ventaItem->created_at }}
                                        </td>
                                        <td>
                                            <a class="tabla_editar"
                                                href="{{ route('administrador.venta.editar', $ventaItem) }}">
                                                <i class="fa-solid fa-pencil"></i></a>
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

</div>
