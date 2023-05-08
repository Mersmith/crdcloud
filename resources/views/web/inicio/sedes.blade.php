<!--CENTRAR ELEMENTOS-->
<div class="centrar_elementos" x-data id="seccion_sedes">
    <div class="contenedor_item_informacion" x-data="{ activarTab: 0 }">
        <!--TÍTULO-->
        <div class="titulo_servicios">
            <h2>Nuestras sedes</h2>
        </div>

        <!--BOTONES-->
        <div class="contenedor_botones_tab">
            <button @click="activarTab = 0"
                x-bind:style="{
                    backgroundColor: activarTab === 0 ? '#189bb6' : '#f0f0f0',
                    color: activarTab === 0 ? 'white' : 'black'
                }">Miraflores</button>
            <button @click="activarTab = 1"
                x-bind:style="{
                    backgroundColor: activarTab === 1 ? '#189bb6' : '#f0f0f0',
                    color: activarTab === 1 ? 'white' : 'black'
                }">La
                Molina</button>
            <button @click="activarTab = 2"
                x-bind:style="{
                    backgroundColor: activarTab === 2 ? '#189bb6' : '#f0f0f0',
                    color: activarTab === 2 ? 'white' : 'black'
                }">San
                Juan de Lurigancho</button>
            <button @click="activarTab = 3"
                x-bind:style="{
                    backgroundColor: activarTab === 3 ? '#189bb6' : '#f0f0f0',
                    color: activarTab === 3 ? 'white' : 'black'
                }">Los
                Olivos</button>
            <button @click="activarTab = 4"
                x-bind:style="{
                    backgroundColor: activarTab === 4 ? '#189bb6' : '#f0f0f0',
                    color: activarTab === 4 ? 'white' : 'black'
                }">San
                Isidro</button>
        </div>

        <!--MIRAFLORES-->
        <div :class="{ 'activo': activarTab === 0 }" x-show.transition.in.opacity.duration.600="activarTab === 0">
            <div class="contenedor_parrafo_video">
                <!--HORARIO-->
                <div class="horario_informacion">
                    <h3 class="titulo_horario">Horario de Atención:</h3>
                    <p><strong>Lunes -Viernes:</strong> 9:00 am a 20:00 pm</p>
                    <p><strong>Sábado:</strong> 9:00 am a 19:00 pm</p>
                    <p><strong>Teléfono:</strong> 01 245-1141</p>
                    <p><strong>Dirección:</strong> Av. José Pardo N° 138 Piso 3 Of. 306</p>
                    <p><strong>Referencia:</strong> Edificio Neptuno
                        Al costado de Saga Falabella</p>
                    <p><strong>Correo:</strong> miraflores@centroradiologico.com.pe</p>

                    <a href="https://api.whatsapp.com/send/?phone=51997890934&text&type=phone_number&app_absent=0"
                        target="_blank" class="whatsapp_boton"> <i class="fa-brands fa-whatsapp"></i> Comunícate
                        con
                        nosotros</a>
                </div>

                <!--VIDEO-->
                <div class="video_informacion">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/w0u3v6Xv0AE"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!--MAPA-->
            <div class="contenedor_mapa_sede">
                <h3 class="titulo_horario">Nuestra dirección:</h3>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3900.902879348996!2d-77.02989749999999!3d-12.118797299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c8177b4ceef5%3A0x52b1dfa139f09d35!2sAv.%20Jos%C3%A9%20Pardo%20138%2C%20Lima%2015074!5e0!3m2!1ses!2spe!4v1681490982062!5m2!1ses!2spe"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>

        <!--LA MOLINA-->
        <div :class="{ 'activo': activarTab === 1 }" x-show.transition.in.opacity.duration.600="activarTab === 1">
            <div class="contenedor_parrafo_video">
                <!--HORARIO-->
                <div class="horario_informacion">
                    <h3 class="titulo_horario">Horario de Atención:</h3>
                    <p><strong>Lunes -Viernes:</strong> 9:00 am a 20:00 pm</p>
                    <p><strong>Sábado:</strong> 9:00 am a 19:00 pm</p>
                    <p><strong>Teléfono:</strong> 01 443-4319</p>
                    <p><strong>Dirección:</strong> Av. Javier Prado N° 5250 Piso 2 Of. 205</p>
                    <p><strong>Referencia:</strong> Centro Comercial La Fontana
                        Av. Javier Prado con Los Frutales</p>
                    <p><strong>Correo:</strong> lamolina@centroradiologico.com.pe</p>

                    <a href="https://api.whatsapp.com/send/?phone=51958720825&text&type=phone_number&app_absent=0"
                        target="_blank" class="whatsapp_boton"> <i class="fa-brands fa-whatsapp"></i> Comunícate
                        con
                        nosotros</a>
                </div>

                <!--VIDEO-->
                <div class="video_informacion">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/JBTP8HkgRIw"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!--MAPA-->
            <div class="contenedor_mapa_sede">
                <h3 class="titulo_horario">Nuestra dirección:</h3>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.514512809875!2d-76.96408389999999!3d-12.0768883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c6ff54e4e587%3A0x3c19f1e4c5f29f0!2sAv.%20Javier%20Prado%20Este%205250%2C%20La%20Molina%2015023!5e0!3m2!1ses!2spe!4v1681491050736!5m2!1ses!2spe"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>

        <!--SAN JUAN DE LURIGANCHO-->
        <div :class="{ 'activo': activarTab === 2 }" x-show.transition.in.opacity.duration.600="activarTab === 2">
            <div class="contenedor_parrafo_video">
                <!--HORARIO-->
                <div class="horario_informacion">
                    <h3 class="titulo_horario">Horario de Atención:</h3>
                    <p><strong>Lunes -Viernes:</strong> 9:00 am a 20:00 pm</p>
                    <p><strong>Sábado:</strong> 9:00 am a 19:00 pm</p>
                    <p><strong>Teléfono:</strong> 01 651-0256</p>
                    <p><strong>Dirección:</strong> Av. Gran Chimu N° 681 Piso 3 Of. 30</p>
                    <p><strong>Referencia:</strong> Frente al Casino Mambo</p>
                    <p><strong>Correo:</strong> sjl@centroradiologico.com.pe</p>

                    <a href="https://api.whatsapp.com/send/?phone=51997891535&text&type=phone_number&app_absent=0"
                        target="_blank" class="whatsapp_boton"> <i class="fa-brands fa-whatsapp"></i> Comunícate
                        con
                        nosotros</a>
                </div>

                <!--VIDEO-->
                <div class="video_informacion">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/JiL-u5H2v04"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!--MAPA-->
            <div class="contenedor_mapa_sede">
                <h3 class="titulo_horario">Nuestra dirección:</h3>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.25273721343!2d-77.0027203!3d-12.0261137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c5f0e5bb753b%3A0xccf77175c16b63c5!2sCRD%20Centro%20Radiologico%20Digital%20-%20SJL!5e0!3m2!1ses!2spe!4v1681491078534!5m2!1ses!2spe"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>

        <!--LOS OLIVOS-->
        <div :class="{ 'activo': activarTab === 3 }" x-show.transition.in.opacity.duration.600="activarTab === 3">
            <div class="contenedor_parrafo_video">
                <!--HORARIO-->
                <div class="horario_informacion">
                    <h3 class="titulo_horario">Horario de Atención:</h3>
                    <p><strong>Lunes -Viernes:</strong> 9:00 am a 20:00 pm</p>
                    <p><strong>Sábado:</strong> 9:00 am a 19:00 pm</p>
                    <p><strong>Teléfono:</strong> 01 682-3694</p>
                    <p><strong>Dirección:</strong> Av Antúnez de Mayolo 1290 Piso 2 Of 202</p>
                    <p><strong>Referencia:</strong> Altura Cdra.13 Antunez de Mayolo</p>
                    <p><strong>Correo:</strong> losolivos@centroradiologico.com.pe</p>

                    <a href="https://api.whatsapp.com/send/?phone=51983779616&text&type=phone_number&app_absent=0"
                        target="_blank" class="whatsapp_boton"> <i class="fa-brands fa-whatsapp"></i> Comunícate
                        con
                        nosotros</a>
                </div>

                <!--VIDEO-->
                <div class="video_informacion">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/u4py_s0iw5Q"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!--MAPA-->
            <div class="contenedor_mapa_sede">
                <h3 class="titulo_horario">Nuestra dirección:</h3>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.7021252094933!2d-77.0786705!3d-11.9951014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105cf9aa37d054f%3A0xac09069b8b3237e7!2sCRD%20CENTRO%20RADIOLOGICO%20DIGITAL%20-%20LOS%20OLIVOS!5e0!3m2!1ses!2spe!4v1681491097411!5m2!1ses!2spe"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>

        <!--SAN ISIDRO-->
        <div :class="{ 'activo': activarTab === 4 }" x-show.transition.in.opacity.duration.600="activarTab === 4">
            <div class="contenedor_parrafo_video">
                <!--HORARIO-->
                <div class="horario_informacion">
                    <h3 class="titulo_horario">Horario de Atención:</h3>
                    <p><strong>Lunes -Viernes:</strong> 9:00 am a 20:00 pm</p>
                    <p><strong>Sábado:</strong> 9:00 am a 19:00 pm</p>
                    <p><strong>Teléfono:</strong> 01 733-3340</p>
                    <p><strong>Dirección:</strong> Av. Rivera Navarrete 765 Piso 4 Of. 41</p>
                    <p><strong>Referencia:</strong> Al lado del Banco Interbank</p>
                    <p><strong>Correo:</strong> losolivos@centroradiologico.com.pe</p>

                    <a href="https://api.whatsapp.com/send/?phone=51974302430&text&type=phone_number&app_absent=0"
                        target="_blank" class="whatsapp_boton"> <i class="fa-brands fa-whatsapp"></i>
                        Comunícate
                        con
                        nosotros</a>
                </div>

                <!--VIDEO-->
                <div class="video_informacion">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/qCq6UwqkoVo"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!--MAPA-->
            <div class="contenedor_mapa_sede">
                <h3 class="titulo_horario">Nuestra dirección:</h3>
                <div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7802.51036583047!2d-77.026333!3d-12.094675!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c865c73fcfa7%3A0x9df46d4bc80df81a!2sof%2041%2C%20Av.%20Rivera%20Navarrete%20765%2C%20San%20Isidro%2015046!5e0!3m2!1ses!2spe!4v1681491128502!5m2!1ses!2spe"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </div>
    </div>
</div>
