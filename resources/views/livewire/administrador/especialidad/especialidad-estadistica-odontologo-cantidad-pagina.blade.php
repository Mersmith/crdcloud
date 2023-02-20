<div class="contenedor_administrador_contenido">

    @if ($especialidad_odontologo_cantidad->count())


        <!--TABLA-->
        <div class="tabla_administrador py-4 overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th>
                                Nombres</th>
                            <th>
                                Descripción</th>
                            <th>
                                Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($especialidad_odontologo_cantidad as $item)
                            <tr>
                                <td>
                                    {{ $item->nombre }}
                                </td>
                                <td>
                                    {{ $item->cantidad }}
                                </td>
                                <td>
                                    <a href="{{ route('administrador.especialidad.informacion', $item->id) }}">
                                        <i class="fa-solid fa-eye" style="color: #009eff;"></i>
                                    </a>
                                    |
                                    <a href="">
                                        <span><i class="fa-solid fa-pencil"></i></span>
                                    </a>
                                    |
                                    <a style="color: red;">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@else
<div class="contenedor_no_existe_elementos">
    <p>No hay elementos</p>
    <i class="fa-solid fa-spinner"></i>
</div>
@endif

</div>
