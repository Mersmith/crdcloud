<div>
    <!--SEO-->
    @section('tituloPagina', 'Paciente | Ver')

    <!--TITULO-->
    <h1>Paciente</h1>

    <!--BOTONES-->
    <a href="{{ route('administrador.paciente.index') }}">
        <i class="fa-solid fa-arrow-left-long"></i> Regresar |</a>
    <button wire:click="$emit('eliminarClienteModal')">
        Eliminar |
    </button>
    <a href="{{ route('administrador.paciente.odontologo.todo', $paciente) }}">
        Odontologos |</a>
    <a href="{{ route('administrador.paciente.clinica.todo', $paciente) }}">
        Clinicas |</a>
    <!--DATOS-->
    <div>
        <div>
            <p>Nombre: {{ $paciente->nombre }} </p>
            <p>DNI: {{ $usuario->dni }} </p>
            <p>Registro Sede: {{ $paciente->sede->nombre }} </p>
        </div>
    </div>

    @if ($odontologos->count())
        <h1>ODONTOLOGOS</h1>

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
                            @foreach ($odontologos as $odontologo)
                                <tr>
                                    <td>
                                        {{ $odontologo->nombre }}
                                    </td>
                                    <td>
                                        {{ $odontologo->apellido }}
                                    </td>
                                    <td>
                                        {{ $odontologo->sede->nombre }}
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

    @if ($clinicas->count())
        <h1>CLINICAS</h1>

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
                            @foreach ($clinicas as $clinica)
                                <tr>
                                    <td>
                                        {{ $clinica->nombre }}
                                    </td>
                                    <td>
                                        {{ $clinica->apellido }}
                                    </td>
                                    <td>
                                        {{ $clinica->sede->nombre }}
                                    </td>
                                    <td>
                                        {{ $clinica->email }}
                                    </td>
                                    <td>
                                        {{ $clinica->user->dni }}
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
