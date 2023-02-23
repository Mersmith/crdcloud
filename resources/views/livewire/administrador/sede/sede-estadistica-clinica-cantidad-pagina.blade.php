<div>
    @section('tituloPagina', 'Sedes | Clínicas')

    <!--CONTENEDOR CABECERA-->
    <div class="contenedor_administrador_cabecera">
        <!--CONTENEDOR TITULO-->
        <div class="contenedor_titulo_admin">
            <h2>Cantidad de clínicas por sede </h2>
        </div>
        <!--CONTENEDOR BOTONES-->
        <div class="contenedor_botones_admin">
            <a href="{{ route('administrador.sede.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i> Regresar</a>
        </div>
    </div>

    <!--CONTENEDOR PÁGINA ADMINISTRADOR-->
    <div class="contenedor_administrador_contenido">

        <!--TABLA CLÍNICA-->
        <div class="contenedor_panel_producto_admin">
            @if ($sede_clinica_cantidad->count())
                <!--CONTENEDOR SUBTITULO-->
                <div class="contenedor_subtitulo_admin">
                    <h3>Lista de sedes y cantidad de clínicas</h3>
                </div>

                <!--CONTENEDOR BOTONES-->
                <div class="contenedor_botones_admin">
                    <button>
                        PDF <i class="fa-solid fa-file-pdf"></i>
                    </button>
                    <button>
                        EXCEL <i class="fa-regular fa-file-excel"></i>
                    </button>
                    <button onClick="window.scrollTo(0, document.body.scrollHeight);">
                        Abajo <i class="fa-solid fa-arrow-down"></i>
                    </button>
                </div>

                <!--TABLA-->
                <div class="tabla_administrador py-4 overflow-x-auto">
                    <div class="inline-block min-w-full overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th>
                                        Nº</th>
                                    <th>
                                        Sede</th>
                                    <th>
                                        Cantidad</th>
                                    <th>
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sede_clinica_cantidad as $item)
                                    <tr style="text-align: center;">
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $item->nombre }}
                                        </td>
                                        <td>
                                            {{ $item->cantidad }}
                                        </td>
                                        <td>
                                            <a style="color: #009eff;"
                                                href="{{ route('administrador.sede.clinica.todo', $item->id) }}">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="contenedor_no_existe_elementos">
                    <p>No hay elementos</p>
                    <i class="fa-solid fa-spinner"></i>
                </div>
            @endif
        </div>

        <!--ESTADÍSTICA CLÍNICA-->
        <div class="contenedor_panel_producto_admin">
            @php
                $label_chart_sede_clinicas = [];
                $data_chart_sede_clinicas = [];
            @endphp

            @if (count($sede_clinica_cantidad))
                @php
                    foreach ($sede_clinica_cantidad as $item) {
                        array_push($label_chart_sede_clinicas, $item->nombre);
                        array_push($data_chart_sede_clinicas, $item->cantidad);
                    }
                @endphp
                <canvas id="chart_sede_clinicas"></canvas>
            @endif
        </div>

    </div>

</div>

@push('script')
    <script>
        const ctx_chart_sede_clinicas = document.getElementById('chart_sede_clinicas');
        new Chart(ctx_chart_sede_clinicas, {
            type: 'bar',
            data: {
                labels: {{ Js::from($label_chart_sede_clinicas) }},
                datasets: [{
                    label: 'CANTIDAD DE CLÍNICAS POR SEDES',
                    data: {{ Js::from($data_chart_sede_clinicas) }},
                    borderWidth: 1,
                    backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)', 'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)', 'rgba(255, 159, 64, 0.8)', 'rgba(255, 0, 0, 0.8)',
                        'rgba(0, 255, 0, 0.8)', 'rgba(0, 0, 255, 0.8)', 'rgba(255, 255, 0, 0.8)',
                        'rgba(255, 0, 255, 0.8)', 'rgba(0, 255, 255, 0.8)', 'rgba(128, 0, 0, 0.8)',
                        'rgba(0, 128, 0, 0.8)', 'rgba(0, 0, 128, 0.8)'
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
