<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>

<h1>Perfil</h1><br>

@if($usuarios->isNotEmpty())

    @php
        $nombreActual = null; 
    @endphp

    @foreach($usuarios as $usuario)
        @if($nombreActual !== $usuario->Nombre_usuario)
            @php
                $nombreActual = $usuario->Nombre_usuario;
            @endphp

            <h2>Nombre de Usuario:</h2>
            <p>{{ $usuario->Nombre_usuario }}</p><br>
            <h2>Correo Electrónico: </h2>
            <p>{{ $usuario->Correo_electronico }}</p>

           
            <h1>Favoritas</h1><br>

@foreach($favoritas as $favorita)
    <h2>{{ $favorita->nombre_album }}</h2><br>
    <h2>{{ $favorita->nombre }}</h2><br>
    <img style="width: 200px; height: 200px" src="{{ asset('storage/' . $favorita->imagen) }}" alt=""><br>
    <audio src="{{ asset('storage/' . $favorita->musica) }}" controls loop preload="metadata"></audio>
    
@endforeach
            <h1>Musicas</h1>  
        @endif
        

      
        @if($usuario->musica)
            <img src="{{ asset('storage/' . $usuario->imagen) }}" style="max-width: 150px;"><br>
            <h2>{{ $usuario->Musica }}</h2>
            <h2>{{ $usuario->fecha }}</h2>
            <audio class="audio" src="{{ asset('storage/' . $usuario->musica) }}" controls loop preload="metadata"></audio> <br>
        @else
            <p>No hay música cargada de este usuario.</p>
        @endif
    @endforeach

@else
    <p>No hay información disponible.</p>
@endif

</body>
</html>
