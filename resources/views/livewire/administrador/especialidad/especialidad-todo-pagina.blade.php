<div>
    <!--SEO-->
    @section('tituloPagina', 'Especialidades')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Especialidades</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.especialidad.crear') }}">
                Nueva especialidad <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('administrador.especialidad.estadistica.odontologo.cantidad') }}">
                Cantidad odontólogos <i class="fa-solid fa-user-doctor"></i></a>

            <a href="{{ route('administrador.especialidad.estadistica.clinica.cantidad') }}">
                Cantidad clínicas <i class="fa-solid fa-house-medical-flag"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--BUSCADOR-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="contenedor_elemento_item">
                <p class="estilo_nombre_input">Buscar especialidad: <span class="campo_opcional">(Opcional)</span>
                </p>
                <input type="text" wire:model="buscarEspecialidad" placeholder="Buscar...">
            </div>
        </div>

        <!--TABLA-->
        <div class="contenedor_panel_producto_admin">
            @if ($especialidades->count())
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista de especialidades <span> Cantidad: {{ $cantidad_total_especialidades }}</span> </h3>
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
                                        Descripción</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($especialidades as $especialidad)
                                    <tr>
                                        <td style="text-align: center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td style="text-align: center">
                                            {{ $especialidad->nombre }}
                                        </td>
                                        <td>
                                            {{ $especialidad->descripcion }}
                                        </td>
                                        <td style="text-align: center">
                                            <a style="color: #009eff;"
                                                href="{{ route('administrador.especialidad.informacion', $especialidad) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a style="color: green;"
                                                href="{{ route('administrador.especialidad.editar', $especialidad) }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($especialidades->hasPages())
                    <div>
                        {{ $especialidades->links('pagination::tailwind') }}
                    </div>
                @endif
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay especialidades.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

    </div>
</div>
