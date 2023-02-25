<div>
    <!--SEO-->
    @section('tituloPagina', 'Pacientes')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Pacientes de: {{ $clinica->nombre_clinica . ' - ' . $clinica->nombre . ' '. $clinica->apellido }}</h2>
        </div>

        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.clinica.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('administrador.clinica.paciente.crear', $clinica) }}">
                Nuevo Paciente <i class="fa-solid fa-square-plus"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--BUSCADOR-->
        <div class="contenedor_panel_producto_admin formulario">
            <div class="contenedor_elemento_item">
                <p class="estilo_nombre_input">Buscar paciente: <span class="campo_opcional">(Opcional)</span> </p>
                <input type="text" wire:model="buscarPaciente" placeholder="Buscar...">
            </div>
        </div>

        @if ($pacientes->count())
            <!--TABLA-->
            <div class="contenedor_panel_producto_admin">
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista ({{ $pacientes_cantidad_total }})</h3>
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
                                        DNI</th>
                                    <th>
                                        Celular</th>
                                    <th>
                                        Fecha Nacimiento</th>
                                    <th>
                                        Género</th>
                                    <th>
                                        Registro</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $paciente->nombre }}
                                        </td>
                                        <td>
                                            {{ $paciente->apellido }}
                                        </td>
                                        <td>
                                            {{ $paciente->sede->nombre }}
                                        </td>
                                        <td>
                                            {{ $paciente->email }}
                                        </td>
                                        <td>
                                            {{ $paciente->user->dni }}
                                        </td>
                                        <td>
                                            {{ $paciente->celular }}
                                        </td>
                                        <td>
                                            {{ $paciente->fecha_nacimiento }}
                                        </td>
                                        <td>
                                            {{ $paciente->genero }}
                                        </td>
                                        <td>
                                            {{ $paciente->created_at }}
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('administrador.paciente.informacion', $paciente) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a style="color: green;"
                                                href="{{ route('administrador.clinica.paciente.editar', ['clinica' => $clinica->id, 'paciente' => $paciente->id]) }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($pacientes->hasPages())
                <div>
                    {{ $pacientes->links('pagination::tailwind') }}
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
