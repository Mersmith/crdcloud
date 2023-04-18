<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontólogo - Paciente')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Paciente: {{ $paciente->nombre . ' ' . $paciente->apellido }}</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('odontologo.paciente.odontologo.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--DATOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Datos de tu paciente:</h3>
            </div>
            <div>
                <div>
                    <p><strong>Nombre: </strong>{{ $paciente->nombre }} </p>
                    <p><strong>Apellido: </strong>{{ $paciente->apellido }} </p>

                    @if ($paciente->dni)
                        <p><strong>DNI: </strong>{{ $paciente->dni }} </p>
                    @elseif ($paciente->carnet_extranjeria)
                        <p><strong>Carnet: </strong>{{ $paciente->carnet_extranjeria }} </p>
                    @else
                    @endif

                    <p><strong>Celular: </strong>{{ $paciente->celular }} </p>
                    <p><strong>Género: </strong>{{ $paciente->genero }} </p>
                    <p><strong>Email: </strong>{{ $paciente->email }} </p>
                    <p><strong>Fecha: </strong>{{ $paciente->created_at }} </p>
                    <p><strong>Sede CRD: </strong>{{ implode(',', $sedes) }} </p>
                </div>
            </div>
        </div>

        <!--DIRECCIÓN-->
        @if ($direccion)
            <div class="contenedor_panel_producto_admin">
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Dirección de tu paciente:</h3>
                </div>

                <div>
                    <p><strong>Departamento: </strong>{{ $direccion->departamento_nombre }} </p>
                    <p><strong>Provincia: </strong>{{ $direccion->provincia_nombre }} </p>
                    <p><strong>Distrito: </strong>{{ $direccion->distrito_nombre }} </p>
                    <p><strong>Dirección: </strong>{{ $direccion->direccion }} </p>
                    <p><strong>Referencia: </strong>{{ $direccion->referencia }} </p>
                    <p><strong>Código postal: </strong>{{ $direccion->codigo_postal }} </p>
                </div>
            </div>
        @endif

        <!--LISTA ODONTÓLOGOS-->
        @if ($odontologos->count())
            <div class="contenedor_panel_producto_admin">
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Odontólogo:</h3>
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
                                        DNI</th>
                                    <th>
                                        Celular</th>
                                    <th>
                                        Nacimiento</th>
                                    <th>
                                        Género</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($odontologos as $odontologo)
                                    <tr style="text-align: center;">
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
                                            {{ $odontologo->dni }}
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!--LISTA CLÍNICAS-->
        @if ($clinicas->count())
            <div class="contenedor_panel_producto_admin">
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Clínica:</h3>
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
                                        DNI</th>
                                    <th>
                                        Celular</th>
                                    <th>
                                        Nacimiento</th>
                                    <th>
                                        Género</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clinicas as $clinica)
                                    <tr style="text-align: center;">
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!--LISTA VENTAS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Radiografías:</h3>
            </div>
            @if ($ventas->count())
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
                                        N° Orden</th>
                                    <th>
                                        Exámen</th>
                                    <th>
                                        Estado</th>
                                    <th>
                                        Link</th>
                                    <th>
                                        Descarga</th>
                                    <th>
                                        Registro</th>
                                    <th>
                                        Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $ventaItem)
                                    <tr style="text-align: center;">
                                        <td>
                                            {{ $ventaItem->id }}
                                        </td>
                                        <td>
                                            {{ $ventaItem->nombre }}
                                        </td>
                                        <td>
                                            @switch($ventaItem->estado)
                                                @case(1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(245, 171, 11);">
                                                        Falta Pagar
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(13, 235, 87);">
                                                        Pagado
                                                    </span>
                                                @break

                                                @case(3)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(243, 57, 10);">
                                                        Anulado
                                                    </span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ $ventaItem->link }}" target="_blank"><i
                                                    class="fa-brands fa-google-drive"></i></a>
                                        </td>
                                        <td>
                                            {{ $ventaItem->descargas_imagen }}
                                        </td>
                                        <td>
                                            {{ $ventaItem->created_at }}
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('odontologo.venta.odontologo.informacion', $ventaItem->id) }}">
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
                    <p>No tiene informes.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

        <!--LISTA CANJEOS-->
        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Canjeos:</h3>
            </div>
            @if ($canjeos->count())
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
                                        N° Orden</th>
                                    <th>
                                        Exámen</th>
                                    <th>
                                        Estado</th>
                                    <th>
                                        Registro</th>
                                    <th>
                                        Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($canjeos as $canjeoItem)
                                    <tr style="text-align: center;">
                                        <td>
                                            {{ $canjeoItem->id }}
                                        </td>
                                        <td>
                                            {{ $canjeoItem->nombre }}
                                        </td>
                                        <td>
                                            @switch($canjeoItem->estado)
                                                @case(1)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(245, 171, 11);">
                                                        Proceso
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(13, 235, 87);">
                                                        Canjeado
                                                    </span>
                                                @break

                                                @case(3)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                                        style="background-color: rgb(243, 57, 10);">
                                                        Anulado
                                                    </span>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td>
                                            {{ $canjeoItem->created_at }}
                                        </td>
                                        <td>
                                            @if ($canjeoItem->estado == 1)
                                                <a style="color: green;"
                                                    href="{{ route('odontologo.canjeo.odontologo.editar', $canjeoItem->id) }}">
                                                    <span><i class="fa-solid fa-pencil"></i></span>
                                                </a>
                                            @else
                                                <a style="color: #009eff;"
                                                    href="{{ route('odontologo.canjeo.odontologo.informacion', $canjeoItem->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No tiene canjeos.</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

        <!--LISTA IMÁGENES-->
        {{-- <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Imágenes:</h3>
            </div>
            @if ($imagenes->count())
                <!--CONTENEDOR BOTONES-->
                <div class="contenedor_botones_admin">
                    <button>
                        Descargar ZIP <i class="fa-solid fa-file-zipper"></i>
                    </button>
                </div>
                <div class="contenedor_1_elementos_imagen">
                    <div class="contenedor_imagenes_subidas_dropzone" id="sortableimagenes">
                        @foreach ($imagenes as $key => $imagen)
                            <div>
                                <a href="{{ Storage::url($imagen->imagen_ruta) }}" data-lightbox="gallery">
                                    <img src="{{ Storage::url($imagen->imagen_ruta) }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div> --}}

    </div>

</div>

@push('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': true,
            'alwaysShowNavOnTouchDevices': true,
        })
    </script>
@endpush
