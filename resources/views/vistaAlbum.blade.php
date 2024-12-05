<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albumes</title>
        <link rel="apple-touch-icon" href="{{ asset('icono.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
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
        width: 90%; /* Ancho predeterminado para pantallas pequeñas */
        max-width: 600px; /* Máximo ancho para pantallas más grandes */
        border-radius: 8px; /* Bordes redondeados para un diseño más moderno */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
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

    /* Media query para pantallas más grandes */
    @media (min-width: 768px) {
        .modal-content {
            width: 50%; /* Ajustar ancho en pantallas medianas */
        }
    }

    @media (min-width: 1024px) {
        .modal-content {
            width: 40%; /* Ajustar ancho en pantallas grandes */
        }
    }
</style>
    <script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      // Register a service worker hosted at the root of the
      // site using the default scope.
      navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
         console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
         console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
     console.error("Service workers are not supported.");
  }
</script>
</head>
<body>
@include('sidebar')
<div class="p-4">
    <div class="mt-14">
<h1 class="font-semibold">Musica y albumes subidos por ti!</h1>

        <!-- Reproductor de música para este álbum -->
      
        <div class="md:ml-[12rem] p-14 grid-cols-1 md:grid-cols-3 grid md:flex-row gap-10">    
                 <!-- CARD 1 -->
@if($albumes->isNotEmpty())
    @foreach($albumes as $nombre_album => $canciones)
                  @foreach($canciones as $cancion)
                 <div class="md:w-[18rem] border md:mt-5 shadow-lg mb-10">
                 <h1 class="text-center mt-5 text-lg">Album: {{ $nombre_album }}</h1>
                  <div class="p-5">
                  <form class="flex justify-end" action="{{ route('album.EliminarAlb', ['id' => $canciones->first()->pk_album]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <button class="flex items-center justify-end group hover:underline hover:text-blue-900" type="submit">
                                Eliminar album
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 group-hover:underline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            </button> 
                        </form>
                    <div class="P-2">
                    <img src="{{ asset('storage/' . $cancion->imagen) }}" alt="">
                    </div>
                    <div class="text-center mt-4">
                      <span></span>
                    </div>
                    <!-- <div class="mt-1 text-center">
                      <span>Aqui va el nombre del artista</span>
                    </div> -->
                    <div class="w-full flex mt-5">
                        <audio id="reproductor-{{ $loop->index }}" controls loop preload="metadata"></audio>
                    </div>
                    <div class="border-b mt-7"></div>
                    
                      <div class="flex justify-between mt-4 items-center">
                        <span>
                          <div class="flex">
                            <!-- Aqui va el numero de posicion de la cancion -->
                            <!-- <span>1</span> -->
                            <spans class="">{{ $cancion->nombre }}</span>
                          </div>                       
                        </span>
                       <div class="flex justify-between gap-1">
                        <div>
                            <button class="hover:text-[#007AB7] justify-end flex" onclick="cambiarCancion('reproductor-{{ $loop->parent->index }}', '{{ asset('storage/' . $cancion->musica) }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.983a1.125 1.125 0 0 1 0 1.966l-5.603 3.113A1.125 1.125 0 0 1 9 15.113V8.887c0-.857.921-1.4 1.671-.983l5.603 3.113Z" clip-rule="evenodd" />
                                </svg>
                            </button> 
                        </div>
                                    
                                    <button class="hover:text-[#007AB7] justify-end flex" onclick="abrirModal('{{ $cancion->pk_cancion }}','{{ $cancion->pk_album }}','{{ $cancion->nombre_album }}','{{ $cancion->nombre }}', '{{ asset('storage/' . $cancion->imagen) }}')">
                                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                          <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                          <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>

                                    </button>
                                    <form action="{{ route('cancion.delete') }}" method="POST">
                                         @csrf
                                        <input type="hidden" name="pk_cancion" value="{{ $cancion->pk_cancion }}">
                                       <button class="hover:text-[#007AB7] justify-end flex" id="eliminar-deshacer" type="submit">
                                            @if ($cancion->estatus == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                  <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </button>

                                    </form> 
                       </div>
                        
                      </div>
                             
                  </div>
                  
                    <div class="border-b"></div>
                    
                </div>
                <!-- CARD 1 FIN -->  
                @endforeach
            @endforeach
    </div>
@else
    <p class="text-center text-lg p-10">No has subido ninguna cancion.</p>
@endif

<!-- Modal para editar canción -->
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span onclick="cerrarModal()" class="close">&times;</span>
                        <h2 class="text-center text-3xl font-bold">Actualizar los datos</h2>
                        <div class="justify-center items-center flex flex-col">
                        <div class="mt-10 flex flex-col w-[21rem] p-5">
                            <form action="{{ route('cancion.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h2 class="font-semibold text-lg">Actualizar los datos del album</h2>
                            <div>
                            <input class="w-full" type="hidden" name="pk_cancion" id="pk_cancion">
                            </div>
                            <div class="py-2">
                            <input class="w-full" type="hidden" name="pk_album" id="pk_album">
                            </div>
                           <div>
                            <label class="font-semibold" for="nombre_album">Nombre del album:</label>
                            <input class="w-full" type="text" name="nombre_album" id="nombre_album">
                            </div>
                
                            <div class="py-2">
                            <label class="font-semibold" for="imagen_album">Imagen del album:</label>
                            <input class="w-full" type="file" name="imagen_album">
                            </div>
                
                            <h2 class="mt-5 font-semibold text-lg">Actualizar los datos de la canción</h2>
                            <div class="py-2">
                            <label class="font-semibold" for="nombre">Nombre de la canción:</label>
                            <input class="w-full" type="text" name="nombre" id="nombre">
                             </div>
                             <div>
                            <label class="font-semibold" for="imagen">Imagen de la canción:</label>
                            <input class="w-full" type="file" name="imagen">
                            </div>
                            <div class="mt-5 py-2">
                            <button class="border-[2px] p-2 w-full hover:bg-black hover:text-white border-black" type="submit">Actualizar</button>
                             </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--  Mostrar mensajes de SweetAlert basados en la sesión -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '{{ session("error") }}',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>
    @endif

    <script>
    // Modal de editar canción
    function abrirModal(pk_cancion, pk_album, nombre_album, nombre, imagenUrl) {
        document.getElementById('pk_cancion').value = pk_cancion;
        document.getElementById('pk_album').value = pk_album;
        document.getElementById('nombre_album').value = nombre_album;
        document.getElementById('nombre').value = nombre;
      
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

</body>
</html>
