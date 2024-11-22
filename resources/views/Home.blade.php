<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Página Principal</title>

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
        .hidden {
            display: none;
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

<h1>Música</h1>



<center>
<div class="md:flex hidden mr-[2rem]">
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <form  action="" method="" >
            <input type="search" class="block w-[20rem] p-4 ps-10 text-sm border border-black bg-gray-50 focus:ring-blue-500 focus:border-blue-500"id="buscarCancion" placeholder="Buscar canción..." oninput="filtrarCanciones()"  required />
        </form>
    </div>
</div>
</center>

<!-- Mostrar canciones recomendadas (limitadas por álbum) solo si hay canciones -->
@foreach($canciones as $nombreAlbum => $cancionesAlbum)
    @if($cancionesAlbum->isNotEmpty())
        <a href="{{ route('albumselect.showcanalb', ['id' => $cancionesAlbum->first()->fk_album]) }}">
            <h1 style="font-size: 20px">Del álbum: {{ $nombreAlbum }}</h1>
        </a>
        @if($cancionesAlbum->first()->imagen)
            <img style="max-width: 150px;" src="{{ asset('storage/' . $cancionesAlbum->first()->imagen) }}" alt="imagen album"><br>
        @endif

        <audio id="reproductor-{{ $loop->index }}" controls loop preload="metadata" style="width: 30%;"></audio>

        @foreach($cancionesAlbum as $cancion)
            <div class="cancion-item">
                <strong>{{ $cancion->nombre }}</strong><br>
                <button onclick="cambiarCancion('reproductor-{{ $loop->parent->index }}', '{{ asset('storage/' . $cancion->musica) }}')">Reproducir</button><br>
                <p>{{ $cancion->fecha }}</p>
                <button onclick="openModal('{{ $cancion->pk_cancion }}')">Agregar a Favoritas</button>
                <hr>
            </div>
        @endforeach
    @endif
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
<a href="albumselect">album seleccionado</a>

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

    // Verificar si el navegador soporta el elemento <audio>
    if (!document.createElement('audio').canPlayType) {
        document.querySelectorAll('audio').forEach(function(audio) {
            audio.parentElement.classList.add('hidden');
        });
    }


    ///////////////////
    function filtrarCanciones() {
        const input = document.getElementById('buscarCancion').value.toLowerCase();
        const canciones = document.querySelectorAll('strong'); // Seleccionar todos los nombres de canciones

        canciones.forEach(cancion => {
            const nombre = cancion.textContent.toLowerCase();
            if (nombre.includes(input)) {
                cancion.parentElement.style.display = ''; // Mostrar si coincide
            } else {
                cancion.parentElement.style.display = 'none'; // Ocultar si no coincide
            }
        });
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
