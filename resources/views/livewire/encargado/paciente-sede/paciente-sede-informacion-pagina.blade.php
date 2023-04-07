<div>
    <!--SEO-->
    @section('tituloPagina', 'Paciente - Información')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Paciente: {{ $paciente->nombre }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('encargado.paciente.sede.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <a href="{{ route('encargado.paciente.sede.odontologo.todo', $paciente) }}">
                Odontólogos <i class="fa-solid fa-user-doctor"></i></a>
            <a href="{{ route('encargado.paciente.sede.clinica.todo', $paciente) }}">
                Clínicas <i class="fa-solid fa-house-medical-flag"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--DATOS-->
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos:</h3>
            </div>
            <div>
                <div>
                    <p><strong>ID: </strong>{{ $paciente->id }} </p>
                    <p><strong>Nombre: </strong>{{ $paciente->nombre }} </p>
                    <p><strong>Apellido: </strong>{{ $paciente->apellido }} </p>
                    <p><strong>Edad: </strong>{{ $paciente->edad }} </p>
                    <p><strong>DNI: </strong>{{ $paciente->dni }} </p>
                    <p><strong>Celular: </strong>{{ $paciente->celular }} </p>
                    <p><strong>Email: </strong>{{ $paciente->email }} </p>
                    <p><strong>Fecha registro: </strong>{{ $paciente->created_at }} </p>
                    <p><strong>Sede CRD: </strong>{{ implode(',', $sedes) }} </p>
                </div>
            </div>

            <!--ACCESOS-->
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Accesos:</h3>
            </div>
            <div>
                <p><strong>Username: </strong>{{ $usuario_paciente->username }} </p>
                <p><strong>Correo: </strong>{{ $usuario_paciente->email }} </p>
            </div>
        </div>

        <!--DIRECCIÓN-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Dirección del paciente:</h3>
            </div>
            @if ($direccion)
                <div>
                    <p><strong>Departamento: </strong>{{ $direccion->departamento_nombre }} </p>
                    <p><strong>Provincia: </strong>{{ $direccion->provincia_nombre }} </p>
                    <p><strong>Distrito: </strong>{{ $direccion->distrito_nombre }} </p>
                    <p><strong>Dirección: </strong>{{ $direccion->direccion }} </p>
                    <p><strong>Referencia: </strong>{{ $direccion->referencia }} </p>
                    <p><strong>Código postal: </strong>{{ $direccion->codigo_postal }} </p>
                    <a href="{{ route('encargado.paciente.sede.direccion.editar', $paciente) }}"
                        class="boton_suelto"><i class="fa-solid fa-pencil"></i> Editar
                        Dirección</a>
                </div>
            @else
                <div>
                    <a href="{{ route('encargado.paciente.sede.direccion.crear', $paciente) }}"
                        class="boton_suelto"><i class="fa-solid fa-square-plus"></i> Crear
                        Dirección</a>
                </div>
            @endif
        </div>

        <!--LISTA ODONTÓLOGOS-->
        <div class="contenedor_panel_producto_admin">
            @if ($odontologos->count())
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Sus odontólogos</h3>
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
                                        Nacimiento</th>
                                    <th>
                                        Género</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($odontologos as $odontologo)
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
                                            {{-- $odontologo->sede->nombre --}}
                                        </td>
                                        <td>
                                            {{ $odontologo->email }}
                                        </td>
                                        <td>
                                            {{ $odontologo->user->dni }}
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
                                            <a style="color: #009eff;"
                                                href="{{ route('encargado.odontologo.sede.informacion', $odontologo) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No tiene odontólogos.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

        <!--LISTA CLÍNICAS-->
        <div class="contenedor_panel_producto_admin">
            @if ($clinicas->count())

                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Sus clínicas</h3>
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
                                        Nacimiento</th>
                                    <th>
                                        Género</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinicas as $clinica)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $clinica->nombre }}
                                        </td>
                                        <td>
                                            {{ $clinica->apellido }}
                                        </td>
                                        <td>
                                            {{-- $clinica->sede->nombre --}}
                                        </td>
                                        <td>
                                            {{ $clinica->email }}
                                        </td>
                                        <td>
                                            {{ $clinica->dni }}
                                        </td>
                                        <td>
                                            {{ $clinica->celular }}
                                        </td>
                                        <td>
                                            {{ $clinica->fecha_nacimiento }}
                                        </td>
                                        <td>
                                            {{ $clinica->genero }}
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('encargado.clinica.sede.informacion', $clinica) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No tiene clínicas.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

    </div>

</div>
