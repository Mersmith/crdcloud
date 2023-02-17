<div>
    @section('tituloPagina', 'Mis Direcciones')
    <!--Titulo-->
    <h2 class="contenedor_paginas_titulo">CREAR DIRECCIÓN</h2>
    <!--Boton regresar-->
    <div class="contenedor_boton_titulo">
        <a href="{{ route('administrador.odontologo.informacion', $odontologo) }}">
            <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
    </div>
    <form wire:submit.prevent="crearDireccion" class="formulario">
        <!--Dos input-->
        <div class="contenedor_2_elementos">
            <!--Direccion-->
            <label class="label_principal">
                <p class="estilo_nombre_input">Dirección: </p>
                <input type="text" wire:model="direccion">
                @error('direccion')
                    <span>{{ $message }}</span>
                @enderror
            </label>
            <!--Referencia-->
            <label class="label_principal">
                <p class="estilo_nombre_input">Referencia: </p>
                <input type="text" wire:model="referencia">
                @error('referencia')
                    <span>{{ $message }}</span>
                @enderror
            </label>
        </div>
        <!--Dos input-->
        <div class="contenedor_2_elementos">
            <!--Codigo-->
            <label class="label_principal">
                <p class="estilo_nombre_input">Código Postal: </p>
                <input type="text" wire:model="codigo_postal">
                @error('codigo_postal')
                    <span>{{ $message }}</span>
                @enderror
            </label>
            <!--Región-->
            <label class="label_principal">
                <p class="estilo_nombre_input">Región: </p>
                <select wire:model="departamento_id">
                    <option value="" selected disabled>Seleccione su región</option>
                    @foreach ($departamentos as $keyDeparmento => $departamento)
                        <option value="{{ $departamento }}">{{ $departamento->nombre }}</option>
                    @endforeach
                </select>
                @error('departamento_id')
                    <span>{{ $message }}</span>
                @enderror
            </label>
        </div>
        <!--Dos input-->
        <div class="contenedor_2_elementos">
            <!--Provincia-->
            <label class="label_principal">
                <p class="estilo_nombre_input">Provincia: </p>
                <select wire:model="provincia_id">
                    <option value="" selected disabled>Seleccione su provincia:</option>
                    @foreach ($provincias as $provincia)
                        <option value="{{ $provincia }}">{{ $provincia->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('provincia_id')
                    <span>{{ $message }}</span>
                @enderror
            </label>
            <!--Distrito-->
            <label class="label_principal">
                <p class="estilo_nombre_input">Distrito: </p>
                <select wire:model="distrito_id">
                    <option value="" selected disabled>Seleccione su distrito:</option>
                    @foreach ($distritos as $distrito)
                        <option value="{{ $distrito }}">{{ $distrito->nombre }}</option>
                    @endforeach
                </select>
                @error('distrito_id')
                    <span>{{ $message }}</span>
                @enderror
            </label>
        </div>
        <!--Enviar-->
        <div class="contenedor_1_elementos">
            <input type="submit" value="Agregar Dirección">
        </div>
    </form>
</div>
