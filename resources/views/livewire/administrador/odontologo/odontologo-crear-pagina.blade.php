<div>
    <!--SEO-->
    @section('tituloPagina', 'Odontologo | Nuevo')

    <!--TITULO-->
    <h1>Crear ondontologo</h1>

    <!--BOTONES-->
    <a href="{{ route('administrador.odontologo.index') }}">
        <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>

    <!--FORMULARIO-->
    <form wire:submit.prevent="crearOdontologo" x-data>
        <!--ESPECIALIDADES-->
        <div>
            <p>Especialidades: </p>
            <select wire:model="especialidad_id">
                <option value="" selected disabled>Seleccione una especialidad</option>
                @foreach ($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                @endforeach
            </select>
            @error('especialidad_id')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--EMAIL-->
        <div>
            <p>Email: </p>
            <input type="email" wire:model="email">
            @error('email')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--PASSWORD-->
        <div>
            <p>Contraseña: </p>
            <input type="password" wire:model="password">
            @error('password')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--NOMBRE-->
        <div>
            <p>Nombre: </p>
            <input type="text" wire:model="nombre">
            @error('nombre')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--APELLIDO-->
        <div>
            <p>Apellido: </p>
            <input type="text" wire:model="apellido">
            @error('apellido')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--DNI-->
        <div>
            <p>DNI: </p>
            <input type="number" wire:model="dni">
            @error('dni')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--COP-->
        <div>
            <p>COP: </p>
            <input type="number" wire:model="cop">
            @error('cop')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--CELULAR-->
        <div>
            <p>Celular: </p>
            <input type="tel" wire:model="celular">
            @error('celular')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--FECHA DE NACIMIENTO-->
        <div>
            <p>Fecha de Nacimiento: </p>
            <input type="date" wire:model="fecha_nacimiento">
            @error('fecha_nacimiento')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--GÉNERO-->
        <div>
            <p>Genero: </p>
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
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--PUNTOS-->
        <div>
            <p>PUNTOS: </p>
            <input type="number" wire:model="puntos">
            @error('puntos')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <!--ENVIAR-->
        <div>
            <input type="submit" value="Crear">
        </div>
    </form>

</div>
