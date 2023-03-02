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

                 <form wire:submit.prevent="register" x-data="{ digitosDni: '', digitosCelular: '', digitosCop: '' }">
                     <!--SEDES Y ESPECIALIDADES-->
                     <div class="contenedor_2_elementos">


                         <!--ESPECIALIDADES-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Especialidades: <span
                                     class="campo_obligatorio">(Obligatorio)</span></p>
                             <select wire:model="especialidad_id" required>
                                 <option value="" selected disabled>Seleccione una especialidad</option>
                                 @foreach ($especialidades as $especialidad)
                                     <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                                 @endforeach
                             </select>
                             @error('especialidad_id')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>

                     <!--EMAIL Y PASSWORD-->
                     <div class="contenedor_2_elementos">
                         <!--EMAIL-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Correo: <span class="campo_obligatorio">(Obligatorio)</span>
                             </p>
                             <input type="email" wire:model="email" required>
                             @error('email')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>

                         <!--PASSWORD-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Contraseña: <span
                                     class="campo_obligatorio">(Obligatorio)</span>
                             </p>
                             <input type="password" wire:model="password" autocomplete="off" required>
                             @error('password')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>

                         <div>
                             <label for="password_confirmation">Confirm Password</label>
                             <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                 required>
                             @error('password_confirmation')
                                 <span>{{ $message }}</span>
                             @enderror
                         </div>
                     </div>

                     <!--NOMBRE Y APELLIDO-->
                     <div class="contenedor_2_elementos">
                         <!--NOMBRE-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Nombres: <span
                                     class="campo_obligatorio">(Obligatorio)</span>
                             </p>
                             <input type="text" wire:model="nombre" required>
                             @error('nombre')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>

                         <!--APELLIDO-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Apellidos: <span
                                     class="campo_obligatorio">(Obligatorio)</span>
                             </p>
                             <input type="text" wire:model="apellido" required>
                             @error('apellido')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>

                     <!--DNI Y COP-->
                     <div class="contenedor_2_elementos">
                         <!--DNI-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">DNI: <span class="campo_obligatorio">(Obligatorio)</span>
                             </p>
                             <input type="number" wire:model="dni" x-ref="digitosDniRef" x-model="digitosDni"
                                 x-on:keydown="limitarEntrada($refs.digitosDniRef, 8, $event)" required>
                             @error('dni')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                             <span wire:click="validarDni">Validar</span>
                         </div>

                         <!--COP-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">COP: <span class="campo_obligatorio">(Obligatorio)</span>
                             </p>
                             <input type="number" wire:model="cop" x-ref="digitosCopRef" x-model="digitosCop"
                                 x-on:keydown="limitarEntrada($refs.digitosCopRef, 6, $event)" required>
                             @error('cop')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                             <span wire:click="validarCop">Validar</span>
                         </div>
                     </div>

                     <!--CELULAR Y FECHA DE NACIMIENTO-->
                     <div class="contenedor_2_elementos">
                         <!--CELULAR-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Celular: <span
                                     class="campo_obligatorio">(Obligatorio)</span></p>
                             <input type="number" wire:model="celular" x-ref="digitosCelularRef"
                                 x-model="digitosCelular"
                                 x-on:keydown="limitarEntrada($refs.digitosCelularRef, 9, $event)" required>
                             @error('celular')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>

                         <!--FECHA DE NACIMIENTO-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Fecha de Nacimiento: <span
                                     class="campo_obligatorio">(Obligatorio)</span></p>
                             <input type="date" wire:model="fecha_nacimiento" required>
                             @error('fecha_nacimiento')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>

                     <!--PUNTOS Y GÉNERO-->
                     <div class="contenedor_2_elementos">

                         <!--GÉNERO-->
                         <div class="contenedor_elemento_item">
                             <p class="estilo_nombre_input">Genero: <span
                                     class="campo_obligatorio">(Obligatorio)</span></p>
                             <div>
                                 <label>
                                     <input type="radio" value="hombre" name="genero" wire:model="genero">
                                     Hombre
                                 </label>
                                 <label>
                                     <input type="radio" value="mujer" name="genero" wire:model="genero">
                                     Mujer
                                 </label>
                             </div>
                             @error('genero')
                                 <span class="campo_obligatorio">{{ $message }}</span>
                             @enderror
                         </div>
                     </div>

                     <!--ENVIAR-->
                     <div class="contenedor_1_elementos">
                         <input type="submit" value="Crear">
                     </div>
                 </form>

             </div>
             </p>
         </div>
     </div>
 </div>

 @push('script')
     <script>
         function limitarEntrada(input, longitudMaxima, event) {
             const valor = input.value;

             if (valor.length >= longitudMaxima && event.key !== 'Backspace' && event.key !== 'Delete' && event.key !==
                 'ArrowLeft' && event.key !== 'ArrowRight') {
                 event.preventDefault();
             }
         }
     </script>
 @endpush
