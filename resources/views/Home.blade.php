<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Página Principal</title>
    <style>
        /* Estilos del modal */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
    </style>
</head>
<body>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>

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
<h2>Del álbum: {{$cancion->nombre_album}}</h2>
    <strong>{{ $cancion->nombre }}</strong><br>
    <img src="{{ asset('storage/' . $cancion->imagen) }}" alt="Imagen de {{ $cancion->nombre }}" style="max-width: 150px;"><br>
    <audio class="audio" src="{{ asset('storage/' . $cancion->musica) }}" controls loop preload="metadata"></audio>
    <p>{{ $cancion->duracion }}</p>
    <p>{{ $cancion->fecha }}</p>

    <!-- Botón para abrir el modal -->
    <button onclick="openModal('{{ $cancion->pk_cancion }}')">Agregar a Favoritas</button>
    <hr>
@endforeach

<!-- Modal -->
<div id="albumModal" class="modal">
    <div class="modal-content">
        <span onclick="closeModal()" style="cursor:pointer;">&times; Cerrar</span>
        <h2>Selecciona un Álbum</h2>
        <form id="favoritaForm" action="{{ route('favorita.store') }}" method="POST">
            @csrf
            <input type="hidden" name="fk_cancion" id="fk_cancion">
            <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}"> <!-- Campo oculto para el ID del usuario -->
            <label for="fk_album">Álbum:</label>
            <select name="fk_album" id="fk_album" required>
                @foreach($albumes as $album)
                    <option value="{{ $album->pk_album }}">{{ $album->nombre_album }}</option>
                @endforeach
            </select>
            <br>
            <button type="submit">Agregar a Favoritas</button>
        </form>
    </div>
</div>
<a href="registrocat">Registrar categoría</a><br>
<a href="registrocan">Registrar canciones</a><br>
<a href="perfil">Perfil</a><br>
<a href="registroAlbum">Registrar Álbum</a><br>
<a href="vistaAlbum">Álbumes</a>

<script>
    function openModal(cancionId) {
        document.getElementById("fk_cancion").value = cancionId; // Establecer el ID de la canción seleccionada
        document.getElementById("albumModal").style.display = "block"; // Mostrar el modal
    }

    function closeModal() {
        document.getElementById("albumModal").style.display = "none"; // Ocultar el modal
    }

    // Cerrar el modal si se hace clic fuera de él
    window.onclick = function(event) {
        if (event.target == document.getElementById("albumModal")) {
            closeModal();
        }
    }
</script>

</body>
</html>
