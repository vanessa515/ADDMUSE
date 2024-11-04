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

<h1>Registra canciones</h1>

<form action="{{ route('regcan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 

    <!-- Campo de texto que mostrará el nombre del archivo de música -->
    <input type="text" id="nombre" name="nombre" placeholder="Nombre del archivo" required maxlength="45"><br>

    <label for="imagen">Imagen:</label>
    <input type="file" name="imagen" placeholder="Imagen" required><br>

    <!-- Campo de archivo para la música, que dispara el evento onchange -->
    <label for="musica">Música:</label>
    <input type="file" id="musica" name="musica" placeholder="Música" required onchange="mostrarNombreArchivo(); obtenerDuracion();"><br>

    <!-- Campo de texto que mostrará la duración de la canción -->
    <label for="duracion">Duración:</label>
    <input type="text" id="duracion" name="duracion" placeholder="Duración" readonly required><br>

    <label for="fk_categoria">Categoría:</label><br>
    <select name="fk_categoria" id="fk_categoria" class="form-control" required>
        <option value="" disabled selected>Selecciona una opción</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->pk_categorias }}">
                {{ $categoria->nombre_cat }} 
            </option>
        @endforeach
    </select>

    <label for="fk_album">Albumes:</label><br>
    <select name="fk_album" id="fk_album" class="form-control" required>
        <option value="" disabled selected>Selecciona una opción</option>
        @foreach($albumes as $album)
            <option value="{{ $album->pk_album }}">
                {{ $album->nombre_album }} 
            </option>
        @endforeach
    </select>

    <button type="submit">Registrar Canción</button>
</form>

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

</body>
</html>
