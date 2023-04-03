<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontólogo - Distritos')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Distritos</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ URL::previous() }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>

    <div class="contenedor_administrador_contenido">
        <!--BUSCADOR-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="contenedor_elemento_item">
                <p class="estilo_nombre_input">Buscar odontólogo: <span class="campo_opcional">(Opcional)</span> </p>
                <input type="text" wire:model="buscarOdontologo" placeholder="Buscar...">
            </div>
        </div>

        <!--TABLA-->
        @if ($odontologos_distritos->count())
            <!--TABLA-->
            <div class="contenedor_panel_producto_admin">
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
                                        Nº</th>
                                    <th>
                                        Nombres</th>
                                    <th>
                                        Apellidos</th>
                                    <th>
                                        Email</th>
                                    <th>
                                        Celular</th>
                                    <th>
                                        Fecha Nacimiento</th>
                                    <th>
                                        Género</th>

                                    <th>
                                        Puntos</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($odontologos_distritos as $odontologo)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $odontologo->nombre }}
                                        </td>
                                        <td>
                                            {{ $odontologo->apellido }}
                                        </td>

                                        <td>
                                            {{ $odontologo->email }}
                                        </td>

                                        <td>
                                            {{ $odontologo->celular }}
                                        </td>
                                        <td>
                                            {{ $odontologo->fecha_nacimiento }}
                                        </td>
                                        <td>
                                            {{ $odontologo->genero }}
                                        </td>
                                        <td>
                                            {{ $odontologo->puntos }}
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('encargado.odontologo.sede.informacion', $odontologo->odontologo_id) }}">
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

            @if ($odontologos_distritos->hasPages())
                <div>
                    {{ $odontologos_distritos->links('pagination::tailwind') }}
                </div>
            @endif
        @else
            <div class="contenedor_no_existe_elementos">
                <p>No hay elementos</p>
                <i class="fa-solid fa-spinner"></i>
            </div>
        @endif
    </div>
</div>
