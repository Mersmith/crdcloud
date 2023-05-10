<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: inherit;
            text-decoration: none;
        }

        html {
            height: 100%;
            font-family: Verdana, sans-serif;
        }

        body {
            margin: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        img {
           width: 350px;
           opacity: 0.5;
        }

        h2 {
            color: #189bb6;
            font-size: 70px;
        }

        a {
            background-color: #189bb6;
            padding: 10px 15px;
            color: white;
            font-weight: 600;
            border-radius: 4px;
            margin-top: 20px;
        }

        a:hover {
            background-color: #1da4be;
        }
    </style>

</head>

<body>

    <img src="{{ asset('imagenes/error/error-1.png') }}" alt="">

    <h2>
        @yield('code')
    </h2>
    @yield('message')

    {{--<a href="{{ route('inicio') }}">Ir a Inicio</a>--}}

</body>

</html>
