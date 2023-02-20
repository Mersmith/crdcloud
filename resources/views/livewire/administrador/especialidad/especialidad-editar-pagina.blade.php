<div x-data>
     <!--NOMBRE-->
     <div class="contenedor_1_elementos_100">
        <div class="contenedor_elemento_item">

            <p class="estilo_nombre_input">Nombre: <span
                    class="campo_obligatorio">(Obligatorio)</span>
            </p>
            <input type="text" wire:model="editarFormulario.nombre">
            @error('editarFormulario.nombre')
                <span class="campo_obligatorio">{{ $message }}</span>
            @enderror
        </div>
    </div>

     <!--DESCRIPCIÓN-->
     <div class="contenedor_1_elementos_100">
        <div class="contenedor_elemento_item">

            <p class="estilo_nombre_input">Descripción: <span class="campo_opcional">(Opcional)</span>
            </p>
            <textarea rows="2" wire:model="editarFormulario.descripcion"></textarea>
            @error('editarFormulario.descripcion')
                <span class="campo_obligatorio">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!--ENVIAR-->
    <div>
        <button wire:loading.attr="disabled" wire:target="editarEspecialidad" wire:click="editarEspecialidad">
            Actualizar
        </button>
    </div>
</div>