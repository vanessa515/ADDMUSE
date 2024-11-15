<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albumes</title>
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
<br><br><br>
<h1>Albumes</h1>
@if($albumes->isNotEmpty())
    @foreach($albumes as $nombre_album => $canciones)
        <h1 style="font-size: 20px">Del álbum: {{ $nombre_album }}</h1>

        @if($canciones->first()->imagen)
            <img style="max-width: 150px;" src="{{ asset('storage/' . $canciones->first()->imagen_album) }}" alt="imagen álbum"><br>
        @endif

        <!-- Reproductor de música para este álbum -->
        <audio id="reproductor-{{ $loop->index }}" controls loop preload="metadata" style="width: 30%;"></audio>

        @foreach($canciones as $cancion)
        <img style="width: 20px; height: auto;" src="{{ asset('storage/' . $cancion->imagen) }}" alt=""> <strong>{{ $cancion->nombre }}</strong> 
          
            <button onclick="abrirModal('{{ $cancion->pk_cancion }}', '{{ $cancion->nombre }}', '{{ asset('storage/' . $cancion->imagen) }}')">Editar</button><br>
            
            <form action="{{ route('cancion.delete') }}" method="POST">
                 @csrf
                    <input type="hidden" name="pk_cancion" value="{{ $cancion->pk_cancion }}">
                    <button id="eliminar-deshacer" type="submit">
                        {{ $cancion->estatus == 1 ? 'Eliminar' : 'Deshacer' }}
                    </button>
            </form>


            <button onclick="cambiarCancion('reproductor-{{ $loop->parent->index }}', '{{ asset('storage/' . $cancion->musica) }}')">Reproducir</button><br>
            <hr>
        @endforeach
    @endforeach
@else
    <p>No hay canciones en la lista de favoritas.</p>
@endif

<!-- Modal para editar canción -->
<div id="editModal" class="modal">
    <div class="modal-content">
        
        <h2>Actualizar los datos de la canción</h2>
        <form action="{{ route('cancion.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="pk_cancion" id="pk_cancion">

            <label for="nombre">Nombre de la canción:</label>
            <input type="text" name="nombre" id="nombre"><br><br>

            <label for="imagen">Imagen de la canción:</label>
            <input type="file" name="imagen"><br><br>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>
@include('fotter')

<script>
    // Modal de editar canción
    function abrirModal(pk_cancion, nombre, imagenUrl) {
        document.getElementById('nombre').value = nombre;
        document.getElementById('pk_cancion').value = pk_cancion;

        var modal = document.getElementById("editModal");
        modal.style.display = "block";
    }

    function cerrarModal() {
        var modal = document.getElementById("editModal");
        modal.style.display = "none";
    }

    function cambiarCancion(reproductorId, cancionUrl) {
        var reproductor = document.getElementById(reproductorId);
        reproductor.src = cancionUrl;
        reproductor.play();
    }

    window.onclick = function(event) {
        var modal = document.getElementById("editModal");
        if (event.target == modal) {
            modal.style.display = "none";
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


</body>
</html>
