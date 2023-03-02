 <!--GRID CONTENEDOR LOGIN-->
 <div class="contenedor_login">
    <!--GRID LOGIN IMAGEN-->
    <div class="contenedor_login_imagen">
        <!--IMAGEN-->
        <img src="{{ asset('imagenes/odontologos/1.jpg') }}" alt="" />
        <!--TEXTO-->
        <div>
            <h2>"Canjea tus puntos para que ahorres."</h2>
            <h3>Nickol Sinchi </h3>
            <p>Odontologa</p>
        </div>
    </div>
    <!--GRID LOGIN FORMULARIO-->
    <div class="contenedor_login_formulario">
        <!--FORMULARIO CENTRAR-->
        <div class="login_formulario_centrar">

            <div class="login_formulario_arriba">
                <span>Ya tienes una cuenta?</span>
                <a href="https://centroradiologico.com.pe/crdPunto2/login.php">Registrarse</a>
            </div>

            <div class="login_formulario_logo">
                <a href="{{ route('inicio') }}">
                    <img src="{{ asset('imagenes/empresa/logo.png') }}" alt="" />
                </a>
            </div>

            <h1>¡HOLA! BIENVENIDO DE NUEVO </h1>
            <p>Inicie sesión con los datos que ingresó durante su registro en CRD CLOUD.

            <div class="contenedor_login_inputs">

                <form wire:submit.prevent="login">
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" wire:model.defer="email" required autofocus>
                        @error('email') <span>{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" wire:model.defer="password" required>
                        @error('password') <span>{{ $message }}</span> @enderror
                    </div>

                    <button type="submit">Login</button>
                </form>

            </div>
            </p>
        </div>
    </div>
</div>
