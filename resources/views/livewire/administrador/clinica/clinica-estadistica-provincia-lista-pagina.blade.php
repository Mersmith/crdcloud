<div>
    <!--SEO-->
    @section('tituloPagina', 'Clínica - Provincia')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Provincia</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ URL::previous() }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>
    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">
        <!--LISTA PROVINCIAS-->
        @if ($clinicas_distritos_cantidad->count())

            <!--TABLA-->
            <div class="contenedor_panel_producto_admin">
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Distritos</h3>
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
                                        N°</th>
                                    <th>
                                        Distrito</th>
                                    <th>
                                        Cantidad</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinicas_distritos_cantidad as $distrito)
                                    <tr>
                                       <td>
                                           {{ $loop->iteration }}
                                       </td>
                                        <td>
                                            {{ $distrito->nombre }}
                                        </td>
                                        <td>
                                            {{ $distrito->cantidad }}
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('administrador.clinica.estadistica.distrito.lista', $distrito->id) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No hay elementos</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif

    </div>
</div>
