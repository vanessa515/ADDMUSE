<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>

<h1>Perfil</h1><br>
@include('sidebar')
@if($usuarios->isNotEmpty())

    @php
        $nombreActual = null; // Variable de control para mostrar nombre y correo solo una vez
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

          
                  
                
        <h1>Musicas</h1>  
        @endif
   
        <img src="{{ asset('storage/' . $usuario->imagen) }}"  style="max-width: 150px;"><br>
            <h2>{{ $usuario->Musica }}</h2>
         
            <h2>{{ $usuario->fecha }}</h2>
            <audio class="audio" src="{{ asset('storage/' . $usuario->musica) }}"  controls looppreload="metadata"></audio> <br>
      

        @if($loop->last || $nombreActual !== $usuarios[$loop->index + 1]->Nombre_usuario)
             
        @endif
    @endforeach
@else
    <p>No hay información disponible.</p>
@endif
@include('fotter')
</body>
</html>
