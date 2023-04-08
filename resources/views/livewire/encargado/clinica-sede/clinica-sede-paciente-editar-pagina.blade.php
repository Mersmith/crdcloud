<div>

    <!--SEO-->
    @section('tituloPagina', 'Paciente - Editar')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Editar paciente</h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('encargado.clinica.sede.paciente.todo',  ['clinica' => $odontologo->id]) }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
            <button wire:click="$emit('eliminarPacienteModal')">
                Eliminar paciente <i class="fa-solid fa-trash-can"></i>
            </button>
            <a href="{{ route('encargado.clinica.sede.paciente.crear', ['clinica' => $odontologo->id]) }}">
                Nuevo Paciente <i class="fa-solid fa-square-plus"></i></a>
            <a href="{{ route('encargado.paciente.sede.informacion', $paciente) }}">
                Información del paciente <i class="fa-solid fa-eye"></i></a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">
        <div class="contenedor_panel_producto_admin">

            <!--CONTENEDOR SUBTITULO-->
            <div class="contenedor_subtitulo_admin">
                <h3>Formulario</h3>
            </div>

            <!--FORMULARIO-->
            <form wire:submit.prevent="editarPaciente" x-data="{ digitosDni: '', digitosCelular: '', digitosCop: '' }" class="formulario">

                <!--SEDES-->
                <div class="contenedor_elemento_item">
                    <p class="estilo_nombre_input">Sedes: <span class="campo_obligatorio">(Obligatorio)</span></p>
                    <select wire:model="sedesSeleccionadas" id="sedesSeleccionadas" name="sedesSeleccionadas[]"
                        multiple>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                        @endforeach
                    </select>
                    @error('sedesSeleccionadas')
                        <span class="campo_obligatorio">{{ $message }}</span>
                    @enderror
                </div>

                <!--EMAIL Y NOMBRE-->
                <div class="contenedor_2_elementos">
                    <!--EMAIL-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Correo: <span class="campo_opcional">(Opcional)</span></p>
                        <input type="email" wire:model="email">
                        @error('email')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--NOMBRE-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Nombres: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="nombre">
                        @error('nombre')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--APELLIDO Y EDAD-->
                <div class="contenedor_2_elementos">
                    <!--APELLIDO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Apellidos: <span class="campo_obligatorio">(Obligatorio)</span>
                        </p>
                        <input type="text" wire:model="apellido">
                        @error('apellido')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--EDAD-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Edad: <span class="campo_obligatorio">(Obligatorio)</span></p>
                        <input type="number" wire:model="edad">
                        @error('edad')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!--CELULAR Y GÉNERO-->
                <div class="contenedor_2_elementos">
                    <!--CELULAR-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Celular: <span class="campo_opcional">(Opcional)</span></p>
                        <input type="number" wire:model="celular" x-ref="digitosCelularRef"
                            x-on:keydown="limitarEntrada($refs.digitosCelularRef, 9, $event)" x-init="digitosCelular = $refs.digitosCelularRef.value">
                        @error('celular')
                            <span class="campo_obligatorio">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--GÉNERO-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">Género: <span class="campo_obligatorio">(Obligatorio)</span></p>
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

                <!--TIENE CLÍNICA-->
                <div class="contenedor_1_elementos_100">
                    <!--TIENE CLÍNICA-->
                    <div class="contenedor_elemento_item">
                        <p class="estilo_nombre_input">¿Es extranjero?</p>
                        <div>
                            <label>
                                <input type="radio" value="1" name="es_extranjero"
                                    wire:model.defer="es_extranjero" x-on:click="$wire.es_extranjero = true">
                                Sí
                            </label>
                            <label>
                                <input type="radio" value="0" name="es_extranjero"
                                    wire:model.defer="es_extranjero" x-on:click="$wire.es_extranjero = false">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <!--CARNET EXTRANJERIA Y DNI-->
                @if ($es_extranjero)
                    <!--CARNET EXTRANJERIA-->
                    <div class="contenedor_2_elementos">
                        <!--CARNET EXTRANJERIA-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">Carnet extranjería: <span
                                    class="campo_obligatorio">(Obligatorio)</span></p>
                            <input type="number" wire:model="carnet_extranjeria">
                            @error('carnet_extranjeria')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!--DNI-->
                @else
                    <div class="contenedor_2_elementos">
                        <!--DNI-->
                        <div class="contenedor_elemento_item">
                            <p class="estilo_nombre_input">DNI: <span class="campo_obligatorio">(Obligatorio)</span></p>
                            <input type="number" wire:model="dni" x-ref="digitosDniRef"
                                x-on:keydown="limitarEntrada($refs.digitosDniRef, 8, $event)" x-init="digitosDni = $refs.digitosDniRef.value">
                            @error('dni')
                                <span class="campo_obligatorio">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                <!--ENVIAR-->
                <div class="contenedor_1_elementos">
                    <input type="submit" value="Editar">
                </div>
            </form>

        </div>
    </div>
</div>

@push('script')
    <script>
        function limitarEntrada(input, longitudMaxima, event) {
            const valor = input.value;

            if (valor.length >= longitudMaxima && event.key !== 'Backspace' && event.key !== 'Delete' &&
                event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') {
                event.preventDefault();
            }
        }

        Livewire.on('eliminarPacienteModal', () => {
            Swal.fire({
                title: '¿Quieres eliminar?',
                text: "No podrás recuparlo.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('encargado.clinica-sede.clinica-sede-paciente-editar-pagina',
                        'eliminarPaciente');
                    Swal.fire(
                        '¡Eliminado!',
                        'Eliminaste correctamente.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
