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
                <h1 class="titulo_formulario">CAMBIAR CONTRASEÑA</h1>

                <!--PÁRRAFO-->
                <p class="descripcion_formulario">Cmabie su contraseña con el correo que registro en CRD
                    CLOUD.
                </p>

                <!--FORMULARIO-->
                <form wire:submit.prevent="cambiarClave" class="formulario" style="width: 100%; margin-top: 30px;">


                    <!--TOCKEN-->
                    <input type="hidden" name="token" wire:model="token">

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

                    <!--CONTRASEÑA-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Contraseña:</p>
                            <input type="password" id="password" wire:model="password">
                            @error('password')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--CONFIRMAR CONTRASEÑA-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Confirmar contraseña:</p>
                            <input type="password" id="password_confirmation" wire:model="password_confirmation">
                            @error('password_confirmation')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!--ENVIAR-->
                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item">
                            <input type="submit" value="Cambiar">
                        </div>
                    </div>

                    <div class="contenedor_1_elementos_100">
                        <div class="contenedor_elemento_item" style="text-align: end;">
                            <label for="recordarme" class="estilo_nombre_input">
                                <a href="{{ route('inicio') }}">Ingresar a mi cuenta.</a>
                            </label>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
