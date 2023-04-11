<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontólogo - Puntos')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Tus puntos</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('odontologo.paciente.odontologo.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">

            <div class="formulario">
                <p style="font-size: 20px; font-weight: 700; color: #189bb6;">¡Hola, {{ $odontologo->nombre }}!
                </p>

                <br>

                <div class="contenedor_1_elementos_100">
                    <p>Ya formas parte de los beneficios de CRD Puntos. <br> Ahora puedes canjear muchos servicios
                        <strong> acumulando CRD Puntos</strong> por cada consumo que realices.
                    </p>
                </div>

                <br>

                <div class="contenedor_1_elementos_100">
                    <p><strong>Fecha de ingreso: </strong> {{ $odontologo->created_at->format('d/m/Y') }}</p>
                </div>

                <div class="contenedor_1_elementos_100">
                    <p><strong>Puntos acumulados: </strong>
                        {{ $this->ventasPagadas + $odontologo->puntos_bienvenida - $this->canjeosPagadas }}
                        puntos = S/.
                        {{ ($this->ventasPagadas + $odontologo->puntos_bienvenida - $this->canjeosPagadas) * config('services.crd.puntos_equivale') }}
                    </p>
                </div>

                <br>

                <div class="contenedor_1_elementos_100">
                    <p>Recuerda que 1 punto equivale a {{ config('services.crd.puntos_equivale') }} sol.</p>
                </div>

            </div>
        </div>

        <!--LISTA VENTAS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Sus radiografías: ({{ $cantidad_ventas_canjeos }})</h3>
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
                                    Tipo</th>
                                <th>
                                    Estado</th>
                                <th>
                                    Puntos</th>
                                <th>
                                    Registro</th>
                                <th>
                                    Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cantidad_ventas_canjeos > 0)
                                @foreach (json_decode($ventas_canjeos, true) as $venta_canjeo)
                                    <tr style="text-align: center;">
                                        <td>
                                            {{ $venta_canjeo['id'] }}
                                        </td>
                                        <td>
                                            @if (array_key_exists('total_puntos', $venta_canjeo))
                                                Canjeo
                                            @else
                                                Venta
                                            @endif
                                        </td>
                                        <td>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                style="background-color: rgb(13, 235, 87);">
                                                Pagado
                                            </span>
                                        </td>
                                        <td>
                                            @if (array_key_exists('total_puntos', $venta_canjeo))
                                                -{{ $venta_canjeo['puntos_usados'] }}
                                            @else
                                                +{{ $venta_canjeo['puntos_ganados'] }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ date('d/m/Y H:i:s', strtotime($venta_canjeo['created_at'])) }}
                                        </td>
                                        <td>
                                            @if (array_key_exists('total_puntos', $venta_canjeo))
                                                <a style="color: #009eff;"
                                                    href="{{ route('odontologo.canjeo.odontologo.informacion', $venta_canjeo['id']) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @else
                                                <a style="color: #009eff;"
                                                    href="{{ route('odontologo.venta.odontologo.informacion', $venta_canjeo['id']) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr style="text-align: center;">
                                <td>-</td>
                                <td>Bienvenida</td>
                                <td>-</td>
                                <td>+{{ $odontologo->puntos_bienvenida }}</td>
                                <td>{{ $odontologo->created_at->format('d/m/Y') }}</td>
                                <td>-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
