<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Recuperación de contraseña</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700&display=swap" rel="stylesheet" type="text/css">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
            background-color: #cde6ff;
            color: #000000;
        }

        /*CENTRAR CONTENIDO*/
        .centrar_contenido {
            max-width: 600px;
            margin: 0 auto;
        }

        .correo_electronico {
            background-color: #f7f7f7;
        }

        /*CORREO CABECERA*/
        .correo_cabecera {
            padding: 20px 0px;
            text-align: center;
        }

        .correo_cabecera img {
            width: 180px;
        }

        .correo_cabecera h1 {
            margin-top: 15px;
            line-height: 120%;
            text-align: center;
            word-wrap: break-word;
            font-family: helvetica, sans-serif;
            font-size: 35px;
            font-weight: 700;
        }

        .correo_cabecera p {
            font-size: 17px;
            line-height: 140%;
            word-wrap: break-word;
            font-family: 'Raleway', sans-serif;
        }

        /*CORREO PORTADA*/
        .correo_portada {
            background-color: #189bb6;
            max-width: 960px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            height: 350px;
        }

        .correo_portada img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: top;
            opacity: 0.2;
        }

        .correo_portada .correo_portada_texto {
            position: absolute;
            max-width: 600px;
            padding: 20px;
            text-align: left;
        }

        .correo_portada .correo_portada_texto h2 {
            margin-top: 0;
            font-size: 32px;
            font-weight: bold;
            color: #ffffff;
        }

        .correo_portada .correo_portada_boton {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #fff;
            border-radius: 50px;
            font-size: 16px;
            text-align: center;
            color: #189bb6;
            text-decoration: none;
            font-weight: 600;
        }

        /*CORREO CUERPO*/
        .correo_cuerpo {
            text-align: center;
            padding: 20px;
        }

        .correo_cuerpo p {
            font-size: 14px;
            line-height: 140%;
            text-align: center;
            word-wrap: break-word;
        }

        .correo_cuerpo a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #189bb6;
            border-radius: 50px;
            font-size: 14px;
            text-align: center;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        /*CORREO PIE PAGINAS*/
        .correo_pie_paginas {
            border-top: 1px solid #BBBBBB;
            text-align: center;
            padding: 30px;
        }

        .correo_pie_paginas a {
            text-decoration: none;
        }

        /*CORREO PIE CONTACTO*/
        .correo_pie_contacto {
            padding: 20px 0px;
            font-family: 'Raleway', sans-serif;
            background-color: #189bb6;
            text-align: center;
            color: white;
        }

        .correo_pie_contacto a {
            text-decoration: none;
            color: white;
        }

        @media (max-width: 1000px) {
            .centrar_contenido {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <!--CENTRAR CONTENIDO-->
    <div class="centrar_contenido">

        <!--CORREO ELECTRONICO-->
        <div class="correo_electronico">

            <!--CORREO CABECERA-->
            <div class="correo_cabecera">
                <img class="logo" src="https://centroradiologico.com.pe/imagenes/empresa/logo.png" alt="">
                <h1>RECUPERACIÓN DE <br> CONTRASEÑA</h1>
                <p>Solicitaste la recuperación de la contraseña de tu cuenta.</p>
            </div>

            <!--CORREO PORTADA-->
            <div class="correo_portada">
                <img src="https://crdcloud.centroradiologico.com.pe/imagenes/odontologos/1.jpg" alt="">
                <div class="correo_portada_texto">
                    <h2>Recupera <br> fácil</h2>
                    <a href="{{ $resetLink }}" class="correo_portada_boton">Dale click</a>
                </div>
            </div>

            <!--CORREO CUERPO-->
            <div class="correo_cuerpo">
                <h3>Link para recuperar contraseña</h3>

                <p>Este enlace caducará en <strong>
                        {{ config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') }} </strong>
                    minutos.
                </p>

                <p>Si no has solicitado la recuperación de tu contraseña, por favor ignora este correo.</p>

                <a href="{{ $resetLink }}" class="btn">Restablecer contraseña</a>
            </div>

            <!--CORREO PIE-->
            <div class="correo_pie">
                <!--CORREO PIE PAGINAS-->
                <div class="correo_pie_paginas">
                    <a href="https://centroradiologico.com.pe/" target="_blank">Inicio</a>
                    <span>|</span>
                    <a href="https://www.crdcloud.centroradiologico.com.pe/" target="_blank">CRD Cloud</a>
                </div>

                <!--CORREO PIE CONTACTO-->
                <div class="correo_pie_contacto">
                    <p><a href="mailto:miraflores@centroradiologico.com.pe">
                            miraflores@centroradiologico.com.pe</a></p>

                    <p><a href="tel:+51 997 890 934">+51 997 890 934</a></p>
                </div>
            </div>

        </div>

    </div>
</body>

</html>
