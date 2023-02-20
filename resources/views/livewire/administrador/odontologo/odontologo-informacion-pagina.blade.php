<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontologo - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Información odontólogo</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.odontologo.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('administrador.odontologo.paciente.todo', $odontologo) }}">
                Pacientes <i class="fa-solid fa-user-injured"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos</h3>
            </div>
            <div>
                <p><strong>Nombre: </strong>{{ $odontologo->nombre }} </p>
                <p><strong>Correo: </strong>{{ $usuario_odontologo->email }} </p>
                <p><strong>COP: </strong>{{ $usuario_odontologo->cop }} </p>
                <p><strong>Especialidad: </strong>{{ $especialidad->nombre }} </p>
                <p><strong>Sede: </strong>{{ $odontologo->sede->nombre }} </p>
                <p><strong>Puntos: </strong>{{ $odontologo->puntos }} </p>
            </div>
        </div>

        <!--DIRECCIÓN-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Dirección</h3>
            </div>
            @if ($direccion)
                <div>
                    <p><strong>Departamento: </strong>{{ $direccion->departamento_nombre }} </p>
                    <p><strong>Provincia: </strong>{{ $direccion->provincia_nombre }} </p>
                    <p><strong>Distrito: </strong>{{ $direccion->distrito_nombre }} </p>
                    <p><strong>Dirección: </strong>{{ $direccion->direccion }} </p>
                    <p><strong>Referencia: </strong>{{ $direccion->referencia }} </p>
                    <p><strong>Código postal: </strong>{{ $direccion->codigo_postal }} </p>
                    <a href="{{ route('administrador.odontologo.direccion.editar', $odontologo) }}">Editar
                        Dirección</a>
                </div>
            @else
                <div>
                    <a href="{{ route('administrador.odontologo.direccion.crear', $odontologo) }}">Crear Dirección</a>
                </div>
            @endif
        </div>

        {{-- <!--TABLA-->
        @if ($pacientes->count())
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
                                            <a style="color: green;"
                                                href="{{ route('administrador.paciente.editar', $paciente) }}">
                                                <span><i class="fa-solid fa-pencil"></i></span>
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
        @endif --}}

    </div>
</div>
