<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/style.css">
    <title>Registrar canciones</title>
</head>
<body >


<script>
   
   function mostrarNombreArchivo() {
    // Obtener el input file de música
    var musicaInput = document.getElementById('musica');
    // Obtener el input de texto donde se mostrará el nombre del archivo
    var nombreInput = document.getElementById('nombre');
    
    // Si hay un archivo seleccionado
    if (musicaInput.files.length > 0) {
        // Obtener el nombre del archivo
        var nombreArchivo = musicaInput.files[0].name;
        
        // Verificar si el nombre del archivo excede los 45 caracteres
        if (nombreArchivo.length > 45) {
            alert("El nombre del archivo supera los 45 caracteres. Será truncado.");
            // Truncar el nombre del archivo a 45 caracteres
            nombreArchivo = nombreArchivo.substring(0, 45);
        }

        // Asignar el nombre (truncado si es necesario) al campo de texto
        nombreInput.value = nombreArchivo;
    }
}

function obtenerDuracion() {
    var musicaInput = document.getElementById('musica');
    var duracionInput = document.getElementById('duracion');

    if (musicaInput.files.length > 0) {
        var archivo = musicaInput.files[0];
        var audio = new Audio(URL.createObjectURL(archivo)); // Crear un objeto Audio

        audio.addEventListener('loadedmetadata', function() {
            // Convertir la duración de segundos a minutos:segundos
            var minutos = Math.floor(audio.duration / 60);
            var segundos = Math.floor(audio.duration % 60);
            segundos = segundos < 10 ? '0' + segundos : segundos;

            duracionInput.value = minutos + ':' + segundos; // Mostrar la duración en el input de duración
        });
    }
}

</script>
@include('sidebar')

<div class="justify-center items-center min-h-screen flex flex-col">
<h1 class="text-center text-3xl font-bold">Registra canciones</h1>
<div class="flex flex-col w-[21rem] p-5 shadow-lg border-[2px] border-gray-50 mt-10">
        <form action="{{ route('regcan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 

            <!-- Campo de texto que mostrará el nombre del archivo de música -->
           <div>
            <label class="font-semibold" for="imagen">Nombre de la cancion</label>
            <input class="w-full" type="text" id="nombre" name="nombre" placeholder="Nombre del archivo" required maxlength="45">
           </div>

            <div class="py-2">
            <label class="font-semibold" for="imagen">Imagen de la cancion</label>
            <input class="w-full" type="file" accept=".jpg,.jpeg,.png,.gif" name="imagen" placeholder="Imagen" required>
            </div>

            <!-- Campo de archivo para la música, que dispara el evento onchange -->
            <div>
            <label class="font-semibold" for="musica">Cancion</label>
            <input class="w-full" type="file" accept=".mp3" id="musica" name="musica" placeholder="Música" required onchange="mostrarNombreArchivo(); obtenerDuracion();">
            </div>
            <!-- Campo de texto que mostrará la duración de la canción -->
            <div class="py-2">
            <label class="font-semibold" for="duracion">Duración de la cancion</label>
            <input class="w-full" type="text" id="duracion" name="duracion" placeholder="Duración" readonly required>

            </div>
            <div>
            <label class="font-semibold" for="fk_categoria">Genero musica</label>
            <select class="w-full" name="fk_categoria" id="fk_categoria" class="form-control" required>
                <option value="" disabled selected>Selecciona una opción</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->pk_categorias }}">
                        {{ $categoria->nombre_cat }} 
                    </option>
                @endforeach
            </select>
            </div>

           <div class="py-2">
                <label class="font-semibold" for="fk_album">Del album:</label>
            <select class="w-full" name="fk_album" id="fk_album" class="form-control" required>
                <option value="" disabled selected>Selecciona una opción</option>
                @foreach($albumes as $album)
                    <option value="{{ $album->pk_album }}">
                        {{ $album->nombre_album }} 
                    </option>
                @endforeach
            </select>
           </div>

            <div class="mt-5">
            <button class="border-[2px] p-2 w-full hover:bg-black hover:text-white border-black" type="submit">Registrar Canción</button>
            </div>
        </form>
    </div>
</div>
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
