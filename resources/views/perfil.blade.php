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
    </style>
</head>
<body>
@include('sidebar')

<h1>Perfil</h1><br><br><br>

@if($usuarios->isNotEmpty())
    @php
        $usuario = $usuarios->first(); // Obtén solo el primer usuario
    @endphp
    <p>Cambiar foto de perfil</p>
    <img style="width: 20%; height: auto;" src="{{ asset('storage/' . $usuario->imagen_perfil) }}" alt="user photo">

    <h2>Nombre de Usuario:</h2>
    <p>{{ $usuario->Nombre_usuario }}</p>
    <button id="editBtn">Editar</button>
          

    <h2>Correo Electrónico: </h2>
    <p>{{ $usuario->Correo_electronico }}</p>
@endif
<hr>
<h1>Favoritas</h1>
@if($favoritas->isNotEmpty())
    @foreach($favoritas as $nombreAlbum => $cancionesAlbum)
      
        <h1 style="font-size: 20px">Del álbum: {{ $nombreAlbum }}</h1>

        @if($cancionesAlbum->first()->imagen)
            <img style="max-width: 150px;" src="{{ asset('storage/' . $cancionesAlbum->first()->imagen) }}" alt="imagen álbum"><br>
        @endif

        <!-- Reproductor de música para este álbum -->
        <audio id="reproductor-{{ $loop->index }}" controls loop preload="metadata" style="width: 30%;"></audio>

        @foreach($cancionesAlbum as $cancion)
            <strong>{{ $cancion->nombre }}</strong><br>
            <button onclick="cambiarCancion('reproductor-{{ $loop->parent->index }}', '{{ asset('storage/' . $cancion->musica) }}')">Reproducir</button><br>
            <hr>
            <!--/////////////////////////////////////////////////////////FORMULARIO DESVINCULAR////////////////////////////////////////////////////////////////-->
      
            <form action="{{ route('cancion.desvincular', ['id' => $cancion->pk_cancion]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <button type="submit">Desvincular</button> 
            </form>
        @endforeach
    @endforeach
@else
    <p>No hay canciones en la lista de favoritas.</p>
@endif
        <!-- FIN DEL CONTENEDOR PADDING -->
    </div>
</div>
<!-- Modal para editar perfil -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Actualizar los datos del perfil</h2>
        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="user_name">Nombre de Usuario:</label>
            <input type="text" name="user_name" value="{{ old('Nombre_usuario', $usuario->Nombre_usuario) }}" ><br><br>


            <label for="foto">Actualizar Foto de Perfil:</label>
            <input type="file" name="foto"><br><br>

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

    function cambiarCancion(reproductorId, cancionUrl) {
        var reproductor = document.getElementById(reproductorId);
        reproductor.src = cancionUrl;
        reproductor.play();
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




</body>
</html>
