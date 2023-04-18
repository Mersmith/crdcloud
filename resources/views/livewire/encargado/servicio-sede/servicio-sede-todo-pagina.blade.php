<div>
    <!--SEO-->
    @section('tituloPagina', 'Servicios')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Servicios</h2>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--BUSCADOR-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="contenedor_elemento_item">
                <p class="estilo_nombre_input">Buscar servicio: <span class="campo_opcional">(Opcional)</span>
                </p>
                <input type="text" wire:model="buscarServicio" placeholder="Buscar...">
            </div>
        </div>

        <!--TABLA-->
        <div class="contenedor_panel_producto_admin">
            @if ($servicios->count())
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista de servicios <span> Cantidad: {{ $cantidad_total_servicios }}</span></h3>
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
                                        Nº</th>
                                    <th>
                                        Servicio</th>
                                    <th>
                                        Precio</th>
                                    <th>
                                        Puntos a ganar</th>
                                    <th>
                                        Puntos para canjeo</th>
                                    <th>
                                        Descripción</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicios as $servicio)
                                    <tr>
                                        <td style="text-align: center;">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $servicio->nombre }}
                                        </td>
                                        <td style="text-align: center;">
                                            S/. {{ number_format($servicio->precio_venta, 2, '.', ',') }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $servicio->puntos_ganar }}
                                        </td>
                                        <td style="text-align: center;">
                                            {{ $servicio->puntos_canjeo }}
                                        </td>
                                        <td>
                                            {{ Str::limit($servicio->descripcion, 35) }}
                                        </td>
                                        <td style="text-align: center;">
                                            <a style="color: #009eff;"
                                                href="{{ route('encargado.servicio.sede.informacion', $servicio) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($servicios->hasPages())
                    <div>
                        {{ $servicios->links('pagination::tailwind') }}
                    </div>
                @endif
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay servicios.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>
    </div>
</div>
