<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontólogo - Canjeos')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Canjeos de la clínica: {{$clinica->nombre . ' '. $clinica->apellido }} </h2>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--GRID VENTAS-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="grid_estado_orden">
                <div class="grid_estado_0 estilo_estado_orden" style="background-color: #189bb6;">
                    <a href="{{ route('encargado.clinica.sede.canjeo.todo', $clinica) }}">
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
                    <a href="{{ route('encargado.clinica.sede.canjeo.todo', $clinica) . '?estado=1' }}">
                        <p class="text-center text-2xl">
                            {{ $pendiente }}
                        </p>
                        <p class="uppercase text-center">Proceso</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fas fa-business-time"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_2 estilo_estado_orden" style="background-color: rgb(13, 235, 87);">
                    <a href="{{ route('encargado.clinica.sede.canjeo.todo', $clinica) . '?estado=2' }}">
                        <p class="text-center text-2xl">
                            {{ $pagado }}
                        </p>
                        <p class="uppercase text-center">Canjeado</p>
                        <p class="text-center text-2xl mt-2">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </p>
                    </a>
                </div>
                <div class="grid_estado_3 estilo_estado_orden" style="background-color: rgb(243, 57, 10);">
                    <a href="{{ route('encargado.clinica.sede.canjeo.todo', $clinica) . '?estado=3' }}">
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
                <p class="estilo_nombre_input">Buscar canjeo: <span class="campo_opcional">(Opcional)</span> </p>
                <input type="text" wire:model="buscarNumeroDeVenta" placeholder="Ingrese el número de canjeo o datos del paciente.">
            </div>
        </div>

        <!--TABLA-->
        <div class="contenedor_panel_producto_admin">
            @if ($canjeos->count())

                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista ({{ $todos }})</h3>
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
                                        Nombre</th>
                                    <th>
                                        Apellido</th>
                                    <th>
                                        Registro</th>
                                    <th>
                                        Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($canjeos as $ventaItem)
                                    <tr>
                                        <td style="text-align: center;">
                                            {{ $ventaItem->id }}
                                        </td>
                                        <td>
                                            {{ $ventaItem->paciente_nombre . ' '.  $ventaItem->paciente_apellido}}
                                        </td>
                                        <td>
                                            {{ $ventaItem->nombre_servicio }}
                                        </td>
                                        <td style="text-align: center;">
                                            @switch($ventaItem->estado)
                                                @case(1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(245, 171, 11);">
                                                        Proceso
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(13, 235, 87);">
                                                        Canjeado
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
                                            {{ $ventaItem->nombre }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $ventaItem->apellido }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $ventaItem->created_at }}
                                        </td>
                                        <td style="text-align: center;">
                                                <a style="color: #009eff;"
                                                    href="{{ route('encargado.canjeo.sede.editar', $ventaItem->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                @if ($canjeos->hasPages())
                    <div>
                        {{ $canjeos->links('pagination::tailwind') }}
                    </div>
                @endif
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay canjeos.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>
    </div>

</div>
