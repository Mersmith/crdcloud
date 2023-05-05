<div>
    <!--SEO-->
    @section('tituloPagina', 'Recuperar contraseña')

    <!--GRID CONTENEDOR LOGIN-->
    <div class="contenedor_login">
        <!--GRID LOGIN IMAGEN-->
        <div class="contenedor_login_imagen">
            <!--IMAGEN-->
            <img src="{{ asset('imagenes/odontologos/1.jpg') }}" alt="" />
            <!--TEXTO-->
            <div>
                <h2>"Canjea tus puntos por radiografías."</h2>
                <h3>Nickol Sinchi </h3>
                <p>Odontóloga</p>
            </div>
        </div>

        <!--GRID LOGIN FORMULARIO-->
        <div class="contenedor_login_formulario">
            <!--FORMULARIO CENTRAR-->
            <div class="login_formulario_centrar">

                <!--LOGO-->
                <div class="login_formulario_logo">
                    <a href="{{ route('inicio') }}">
                        <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                    </a>
                </div>

                <!--TITULO-->
                <h1 class="titulo_formulario">RECUPERAR CONTRASEÑA</h1>

                <!--PÁRRAFO-->
                <p class="descripcion_formulario">Recupere su contraseña con el correo que registro en CRD
                    CLOUD.
                </p>

                <!--FORMULARIO-->
                <form wire:submit.prevent="recuperar" class="formulario" style="width: 100%; margin-top: 30px;">
                    <!--EMAIL-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Corre electrónico:</p>
                            <input type="text" id="email" wire:model="email" autofocus>
                            @error('email')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ENVIAR-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <input type="submit" value="Recuperar">
                        </div>
                    </div>

                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item" style="text-align: end;">
                            <label for="recordarme" class="estilo_nombre_input">
                                <a href="{{ route('inicio') }}" class="recuperar_clave">¿Quieres iniciar sesión?</a>
                            </label>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
