<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontólogo - Puntos')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Tus puntos</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('odontologo.paciente.odontologo.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <div class="contenedor_panel_producto_admin">
            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Imagenes en total</h3>
            </div>
            @if ($imagenesTodos->count())
                <div class="contenedor_1_elementos_imagen">
                    <div class="contenedor_imagenes_subidas_dropzone" id="sortableimagenes">
                        @foreach ($imagenesTodos as $key => $imagen)
                            <div>
                                <a href="{{ Storage::url($imagen->imagen_ruta) }}" data-lightbox="gallery">
                                    <img src="{{ Storage::url($imagen->imagen_ruta) }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

    </div>

</div>

@push('script')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': true,
            'alwaysShowNavOnTouchDevices': true
        })
    </script>
@endpush
