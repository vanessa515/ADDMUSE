<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    <!-- Incluir Bootstrap para el Modal (o cualquier otro estilo que prefieras) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
@include('sidebar') 

<br><br><br><br>
<h1>Album seleccionado</h1>
<h1>{{ $album->nombre_album }}</h1>
<img src="{{ asset('storage/' . $album->imagen_album) }}" alt="Imagen del Álbum" style="width:200px;height:auto;">

<ul>
    @foreach($canciones as $cancion)
        <li>
           
            <a href="javascript:void(0)" class="cancion-link" data-id="{{ $cancion['pk_cancion'] }}" data-nombre="{{ $cancion['nombre_cancion'] }}" data-imagen="{{ $cancion['imagen_cancion'] }}" data-musica="{{ $cancion['musica'] }}" data-fecha="{{ $cancion['fecha'] }}">
                <strong>{{ $cancion['nombre_cancion'] }}</strong>
            </a><br>

            <img style="width: 30px; height: auto;" src="{{ asset('storage/' . $cancion['imagen_cancion']) }}" alt="Imagen de la Canción"><br>
            
            <audio controls>
                <source src="{{ asset('storage/' . $cancion['musica']) }}" type="audio/mpeg">
            </audio><br>
            <p>Fecha: {{ $cancion['fecha'] }}</p>
        </li>
        <hr>
    @endforeach
</ul>


<div class="modal fade" id="cancionModal" tabindex="-1" aria-labelledby="cancionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancionModalLabel">Detalles de la Canción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="modalNombreCancion"></h4><hr><br>
                <center>
                <img id="modalImagenCancion" src="" alt="Imagen de la Canción" style="width: 400px; height: auto;">
                <p><strong>Fecha:</strong> <span id="modalFecha"></span></p>
                <audio id="modalMusica" controls>

                    <source src="" type="audio/mpeg">
                    
                </audio>
                </center>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>

    document.querySelectorAll('.cancion-link').forEach(link => {
        link.addEventListener('click', function() {
       
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const imagen = this.getAttribute('data-imagen');
            const musica = this.getAttribute('data-musica');
            const fecha = this.getAttribute('data-fecha');

           
            document.getElementById('modalNombreCancion').innerText = nombre;
            document.getElementById('modalImagenCancion').src = '{{ asset('storage/') }}/' + imagen;
            document.getElementById('modalMusica').src = '{{ asset('storage/') }}/' + musica;
            document.getElementById('modalFecha').innerText = fecha;

     
            const myModal = new bootstrap.Modal(document.getElementById('cancionModal'));
            myModal.show();
        });
    });
</script>

@include('fotter')
</body>
</html>
