<div>
    <!--SEO-->
    @section('tituloPagina', 'Pacientes')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Pacientes</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.especialidad.crear') }}">
                Crear <i class="fa-solid fa-square-plus"></i></a>

            <a href="{{ route('administrador.especialidad.estadistica.odontologo.cantidad') }}">
                Odontologos <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        @if ($especialidades->count())

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
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>PACIENTES</h3>
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
                                        <td>
                                            {{ $especialidad->nombre }}
                                        </td>
                                        <td>
                                            {{ $especialidad->descripcion }}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('administrador.especialidad.informacion', $especialidad) }}">
                                                <i class="fa-solid fa-eye" style="color: #009eff;"></i>
                                            </a>
                                            |
                                            <a href="{{ route('administrador.especialidad.editar', $especialidad) }}">
                                                <span><i class="fa-solid fa-pencil"></i></span>
                                            </a>
                                            |
                                            <a style="color: red;">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($especialidades->hasPages())
                <div>
                    {{ $especialidades->links('pagination::tailwind') }}
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
