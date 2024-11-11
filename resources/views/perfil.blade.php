<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <style>
        /* Estilo básico del modal */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

     
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
@include('sidebar')

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
            <p>{{ $usuario->Nombre_usuario }}</p>
            <button id="editBtn">Editar Nombre</button>
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




<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Nombre de Usuario</h2>
        <form action="{{ route('perfil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="user_name">
                <input type="text" name="user_name" value="{{ old('user_name', $info->user_name) }}" required>
            </label>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>

@include('fotter')

<script>
   
    var modal = document.getElementById("editModal");

 
    var btn = document.getElementById("editBtn");

    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }


    span.onclick = function() {
        modal.style.display = "none";
    }

  
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
