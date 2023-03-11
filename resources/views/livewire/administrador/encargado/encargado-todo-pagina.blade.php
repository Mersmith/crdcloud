<div>
    <!--SEO-->
    @section('tituloPagina', 'Encargados')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Encargados de sedes</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.encargado.crear') }}">
                Nuevo encargado <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--BUSCADOR-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="contenedor_elemento_item">
                <p class="estilo_nombre_input">Buscar encargado: <span class="campo_opcional">(Opcional)</span> </p>
                <input type="text" wire:model="buscarEncargado" placeholder="Buscar...">
            </div>
        </div>

        <!--TABLA-->
        <div class="contenedor_panel_producto_admin">
            @if ($encargados->count())

                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista de encargados <span> Cantidad: {{ $cantidad_total_encargados }}</span></h3>
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
                                        Sede</th>
                                    <th>
                                        Email</th>
                                    <th>
                                        Celular</th>
                                    <th>
                                        Registro</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($encargados as $encargado)
                                    <tr style="text-align: center;">
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $encargado->nombre }}
                                        </td>
                                        <td>
                                            {{ $encargado->apellido }}
                                        </td>
                                        <td>
                                            {{ $encargado->sede->nombre }}
                                        </td>
                                        <td>
                                            {{ $encargado->email }}
                                        </td>
                                        <td>
                                            {{ $encargado->celular }}
                                        </td>
                                        <td>
                                            {{ $encargado->created_at }}
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('administrador.encargado.informacion', $encargado) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a style="color: green;"
                                                href="{{ route('administrador.encargado.editar', $encargado) }}">
                                                <span><i class="fa-solid fa-pencil"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($encargados->hasPages())
                    <div>
                        {{ $encargados->links('pagination::tailwind') }}
                    </div>
                @endif

            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay encargados.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

    </div>
</div>
