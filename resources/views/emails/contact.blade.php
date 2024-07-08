<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        /* Truco para usar Bootstrap en nuestro Email */
        @php
            include 'css/bootstrap.min.css';        
        @endphp

    </style>
</head>

<body class="container p-3">

    <header class="container row bg-light p-4 my-4">
        <figure class="img-fluid col-2">
            <img src="{{ asset('images/logos/logo.png') }}" alt="logo">
        </figure>

        <h1 class="col-10">{{ config('app.name') }}</h1>
    </header>

    <main>
        <h2>Mensaje recibido: {{$mensaje->asunto}}</h2>
        <p class="cursiva">De {{$mensaje->nombre}}
            <a href="mailto:{{$mensaje->email}}">&lt;{{$mensaje->email}}&gt;</a>
        </p>
        <p>{{$mensaje->mensaje}}</p>

    </main>

    <footer class="page-footer font-small p-4 my-4 bg-light">
        <p>Aplicación creada por {{ $autor }} para {{$centro}} como ejemplo de clase. Desarrollada con <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>

</body>

</html>
