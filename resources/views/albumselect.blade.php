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
<div class="p-4">
    <div class="mt-8 flex justify-center">
        <div class="md:w-[40%] mt-[5rem] shadow-lg p-5">
<div class="">
<div class="flex items-center">
                <div>
                    <img src="{{ asset('storage/' . $album->imagen_album) }}" alt="Imagen del Álbum" class=" md:w-[15rem] md:h-[15rem] w-[8rem] h-[8rem]">
                </div>
                <div class="ml-[1rem]">
                    <h1 class="text-3xl md:text-5xl font-bold">{{ $album->nombre_album }}</h1>
                </div>
            </div>
<div class="border-b mt-[3rem] border-black"></div>
<div class="mt-10 mb-10">
   <div class="p-3">
        <ul>
            @foreach($canciones as $cancion)
                <li class="mb-5"> 
                    <div class="flex justify-center md:justify-start">
                        <a href="javascript:void(0)" class="cancion-link" data-id="{{ $cancion['pk_cancion'] }}" data-nombre="{{ $cancion['nombre_cancion'] }}" data-imagen="{{ $cancion['imagen_cancion'] }}" data-musica="{{ $cancion['musica'] }}" data-fecha="{{ $cancion['fecha'] }}">
                            <strong  class="md:ml-2">{{ $cancion['nombre_cancion'] }}</strong>
                        </a>
                    </div>     
                    <div class="flex items-center mt-2">
                        <audio controls class="md:w-[80%]">
                            <source src="{{ asset('storage/' . $cancion['musica']) }}" type="audio/mpeg">
                        </audio>
                    </div>
                </li>      
            @endforeach
        </ul>
   </div>
</div>
</div>


<div class="modal fade" id="cancionModal" tabindex="-1" aria-labelledby="cancionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content  p-5">
            <div class="modal-header">
                <h5 class="modal-title font-bold text-lg" id="cancionModalLabel">Detalles de la Canción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="modalNombreCancion"></h4>
                <p class="mt-2 flex"><strong>Fecha:</strong> <span id="modalFecha"></span></p>
                <center>
                <img id="modalImagenCancion" src="" alt="Imagen de la Canción" class="md:w-[30rem]  md:h-[30rem] w-[10rem] h-[10rem] mt-10">
                <audio class="mt-5"  id="modalMusica" controls>

                    <source src="" type="audio/mpeg">
                    
                </audio>
                </center>
            </div>
        </div>
    </div>
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
</body>
</html>
