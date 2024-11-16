<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Página Principal</title>

    <script>
        if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('service-worker.js')
          .then((registration) => {
            console.log('Service Worker registrado:', registration);
          })
          .catch((error) => {
            console.log('Error:', error);
          });
      }
    </script>

    <style>
        .modal {
            display: none; 
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

@include('sidebar') 

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>
<br><br>

<!-- @if (Auth::check())
    <h1>Bienvenido, {{ Auth::user()->user_name }}!</h1>
    <hr>
@endif -->

<h1>Música</h1>

@foreach($canciones as $nombreAlbum => $cancionesAlbum)
    <h1 style="font-size: 20px">Del álbum: {{ $nombreAlbum }}</h1>
    
    @if($cancionesAlbum->first()->imagen)
        <img style="max-width: 150px;" src="{{ asset('storage/' . $cancionesAlbum->first()->imagen) }}" alt="imagen album"><br>
    @endif
    
    <!-- Reproductor de música para este álbum -->
    <audio id="reproductor-{{ $loop->index }}" controls loop preload="metadata" style="width: 30%;"></audio>

    @foreach($cancionesAlbum as $cancion)
        <strong>{{ $cancion->nombre }}</strong><br>
        <button onclick="cambiarCancion('reproductor-{{ $loop->parent->index }}', '{{ asset('storage/' . $cancion->musica) }}')">Reproducir</button><br>
        <p>{{ $cancion->fecha }}</p>
        <button onclick="openModal('{{ $cancion->pk_cancion }}')">Agregar a Favoritas</button>
        <hr>
    @endforeach
@endforeach

<!-- Modal -->
<div id="albumModal" class="modal">
    <div class="modal-content">
        <span onclick="closeModal()" style="cursor:pointer;">&times; Cerrar</span>
        <h2>Añadir a favoritos u otro album</h2>
        <form id="favoritaForm" action="{{ route('favorita.store') }}" method="POST">
            @csrf
            <input type="hidden" name="fk_cancion" id="fk_cancion">
            <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}"> 
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
<a href="registroAlbum">Registrar Álbum</a><br>




<script>
    function cambiarCancion(reproductorId, urlMusica) {
        const reproductor = document.getElementById(reproductorId);
        reproductor.src = urlMusica;
        reproductor.play();
    }

    function openModal(cancionId) {
        document.getElementById("fk_cancion").value = cancionId; 
        document.getElementById("albumModal").style.display = "block"; 
    }

    function closeModal() {
        document.getElementById("albumModal").style.display = "none"; 
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById("albumModal")) {
            closeModal();
        }
    }
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif


@include('fotter')
</body>
</html>
