<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontologo | Editar')

    <!--TITULO-->
    <h1>Odontologo</h1>

    <!--BOTONES-->
    <a href="{{ route('administrador.odontologo.index') }}">
        <i class="fa-solid fa-arrow-left-long"></i> Regresar |</a>
    <button wire:click="$emit('eliminarClienteModal')">
        Eliminar |
    </button>
    <a href="{{ route('administrador.odontologo.paciente.crear', $odontologo) }}">Crear Paciente |</a>
    <a href="{{ route('administrador.odontologo.paciente.todo', $odontologo) }}">Todos Pacientes |</a>

    <br>
    <br>
    <!--DATOS-->
    <div>
        <h2>Datos</h2>
        <div>
            <p>Nombre: {{ $odontologo->nombre }} </p>
            <p>Correo: {{ $usuario_odontologo->email }} </p>
            <p>COP: {{ $usuario_odontologo->cop }} </p>
            <p>Especialidad: {{ $especialidad->nombre }} </p>
            <p>Sede: {{ $odontologo->sede->nombre }} </p>
            <p>Puntos: {{ $odontologo->puntos }} </p>
        </div>
    </div>
    <br>

    <!--DIRECCIÓN-->
    @if ($direccion)
        <div>
            <h2>Dirección</h2>
            <div>
                <p>Departamento: {{ $direccion->departamento_nombre }} </p>
                <p>Provincia: {{ $direccion->provincia_nombre }} </p>
                <p>Distrito: {{ $direccion->distrito_nombre }} </p>
                <p>Dirección: {{ $direccion->direccion }} </p>
                <p>Referencia: {{ $direccion->referencia }} </p>
                <p>Código postal: {{ $direccion->codigo_postal }} </p>
            </div>
        </div>
        <a href="{{ route('administrador.odontologo.direccion.editar', $odontologo) }}">Editar Dirección</a>

    @else
        <a href="{{ route('administrador.odontologo.direccion.crear', $odontologo) }}">Crear Dirección</a>
    @endif
    <br>

    @if ($pacientes->count())
        <h1>PACIENTES</h1>

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
                            @foreach ($pacientes as $paciente)
                                <tr>
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
                                        <a href="{{-- route('administrador.paciente.odontologo', $paciente) --}}">
                                            <i class="fa-solid fa-eye" style="color: #009eff;"></i>
                                        </a>
                                        |
                                        <a href="{{ route('administrador.paciente.editar', $paciente) }}">
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
    @else
        <div class="contenedor_no_existe_elementos">
            <p>No hay elementos</p>
            <i class="fa-solid fa-spinner"></i>
        </div>
    @endif


</div>
