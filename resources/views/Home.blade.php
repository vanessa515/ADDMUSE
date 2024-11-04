<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Página Principal</title>
</head>
<body>
@include('sidebar')

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>

    <!-- Mostrar nombre del usuario -->
    @if (Auth::check())
        <h1>Bienvenido, {{ Auth::user()->user_name }}!</h1>
        <hr>
    @endif

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <h1>Música</h1>

    @foreach($canciones as $cancion)
        <strong>{{ $cancion->nombre }}</strong><br>
        <img src="{{ asset('storage/' . $cancion->imagen) }}" alt="Imagen de {{ $cancion->nombre }}" style="max-width: 150px;"><br>
        <audio class="audio" src="{{ asset('storage/' . $cancion->musica) }}" controls loop preload="metadata"></audio>
        <p>{{ $cancion->duracion }}</p>
        <p>{{ $cancion->fecha }}</p>
        <hr>
    @endforeach

    <a href="registrocat">Registrar categoría</a><br>
    <a href="registrocan">Registrar canciones</a><br>
    <a href="perfil">Perfil</a>
    <a href="registroAlbum">Album</a>
@include('fotter')
</body>
</html>
