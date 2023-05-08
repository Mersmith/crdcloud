<!--CENTRAR ELEMENTOS-->
<div class="centrar_elementos" id="seccion_beneficios">
    <div class="contenedor_item_servicios">
        <!--TÍTULO-->
        <div class="titulo_servicios">
            <h2>Benefecios de CRD Puntos</h2>
        </div>

        <!--ACORDEON-->
        <div>
            <!--1-->
            <button class="acordeon">
                ¿Qué es CRD Puntos?
            </button>
            <div class="panel_acordeon">
                <p>
                    CRD Puntos es un beneficio, destinado a la fidelización del grupo HT Med Dent, de los
                    que son
                    parte de HT Dent Shop y CRD Cloud. Premiando a nuestros clientes por preferirnos. Para
                    hacerlo, <strong>contamos con puntos que puedes acumular y canjear por servicios y
                        productos exclusivos.</strong></p>
            </div>
            <!--2-->
            <button class="acordeon">
                ¿Todos pueden acumular CRD Puntos?
            </button>
            <div class="panel_acordeon">
                <p>
                    Podrán acceder a este beneficio aquellos odontológos que pertenezcan al sistema CRD
                    Cloud. De esta
                    forma acumularán puntos, <strong>sin necesidad de tener una tarjeta o pagar una
                        exclusividad.</strong></p>
            </div>
            <!--3-->
            <button class="acordeon">
                ¿Qué beneficios me brinda CRD Puntos?
            </button>
            <div class="panel_acordeon">
                <ul>
                    <li>Es de acceso <strong>gratuito.</strong></li>
                    <li>Podrás visualizar tus puntos desde <strong>cualquier dispositivo.</strong></li>
                    <li>El canje y/o acumulación de puntos <strong>es posible en las 24 horas.</strong></li>
                    <li>
                        Gana puntos por cada paciente derivado <strong>a nuestras sedes CRD y/o por compras
                            en
                            nuestras tiendas virtuales autorizadas HT Dent Shop y CRD.</strong>
                    </li>
                </ul>
            </div>
            <!--4-->
            <button class="acordeon">
                ¿Cómo puedo acceder al beneficio CRD Puntos?
            </button>
            <div class="panel_acordeon">
                <strong> Si perteneces al sistema CRD Cloud:</strong>
                <p><strong>Si tienes una cuenta activa en CRD Cloud acumularas CRD Puntos
                        automáticamente</strong> al momento
                    de derivar un paciente a las sedes de CRD o compras en nuestras tiendas virtuales y HT
                    Dent Shop.</p>
                <p>
                    <strong>Para inscribirte solo necesitas completar tus datos.</strong> Al crear una
                    cuenta ya estarás ganando puntos de bienvenida.
                </p>
            </div>
            <!--5-->
            <button class="acordeon">
                ¿Cómo ganar CRD Puntos?
            </button>
            <div class="panel_acordeon">
                <p>
                    Puedes acumular puntos <strong>derivando pacientes a nuestras sedes de CRD y/o comprando
                        en alguna
                        de nuestras plataformas web y HT D Shop.</strong> Los puntos se acumularán de forma
                    automática siempre que la cuenta de usuario este activa e iniciada.
                </p>
            </div>
            <!--6-->
            <button class="acordeon">
                ¿Cuánto equivale un CRD Punto?
            </button>
            <div class="panel_acordeon">
                <p>
                    <strong> Cada CRD Punto equivale a S/1.00.</strong> La acumulación de puntos es
                    ilimitada.
                </p>
            </div>
            <!--7-->
            <button class="acordeon">
                ¿Los puntos en CRD Puntos vencen?
            </button>
            <div class="panel_acordeon">
                <p>
                    <strong>Cada CRD Punto, tiene una vigencia de 02 años.</strong> Los puntos mayores a
                    este tiempo establecido, <strong>serán descontados de los usuarios.</strong>
                </p>
            </div>
            <!--7-->
            <button class="acordeon">
                ¿Dónde puedo revisar el estado de cuenta de mis CRD Puntos?
            </button>
            <div class="panel_acordeon">
                <p>
                    Ingresando a la pagina <a href="https://crdcloud.centroradiologico.com.pe/"
                        target="_blank">wwww.crdcloud.centroradiologico.com.pe</a>
                    . En la pestaña
                    <strong>“Mis CRD Puntos”, podrás visualizar el estado
                        actual de tus puntos.</strong>
                </p>
            </div>
        </div>

    </div>
</div>

@push('script')
    <script>
        var acc = document.getElementsByClassName("acordeon");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                // Función para cerrar todos los paneles
                var cerrarPaneles = function() {
                    var j;
                    for (j = 0; j < acc.length; j++) {
                        if (j !== i) {
                            acc[j].classList.remove("acordeon_activo");
                            acc[j].nextElementSibling.style.display = "none";
                        }
                    }
                };

                cerrarPaneles();

                // Abrir o cerrar el panel actual
                this.classList.toggle("acordeon_activo");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>
@endpush
