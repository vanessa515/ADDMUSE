<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="apple-touch-icon" href="{{ asset('icono.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <title>Página Principal</title>
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
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('/sw.js')
        .then(registration => {
          console.log('Service Worker registrado con éxito:', registration.scope);
        })
        .catch(error => {
          console.error('Error al registrar el Service Worker:', error);
        });
    });
  } else {
    console.log('El navegador no soporta Service Workers.');
  }
</script>
</head>
<body>

@include('sidebar')

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>
<br><br>

<div class="flex mt-10 md:mt-0 justify-center px-10">
    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <form  action="" method="" >
            <input type="search" class="block w-[20rem] md:w-[30rem] p-4 ps-10 text-sm border border-black bg-gray-50 focus:ring-blue-500 focus:border-blue-500"id="buscarCancion" placeholder="Buscar canción..." oninput="filtrarCanciones()"  required />
        </form>
    </div>
</div>

<!-- Mostrar canciones recomendadas (limitadas por álbum) solo si hay canciones -->
<div class="p-4">
         <div class="p-4">
         <h1 class="font-semibold">Encuentra tu musica favorita!!!</h1>
            <!-- CONTENEDOR DE CARDS -->
              <div class="md:ml-[12rem] p-14 grid-cols-1 md:grid-cols-3 grid md:flex-row gap-10">      
@foreach($canciones as $nombreAlbum => $cancionesAlbum)
    @if($cancionesAlbum->isNotEmpty())
                <!-- CARD 1 -->
                <div class="md:w-[18rem] border shadow-lg mb-10">
                  <div class="p-5">
                    <a href="{{ route('albumselect.showcanalb', ['id' => $cancionesAlbum->first()->fk_album]) }}" class="flex justify-end hover:text-sky-500">
                      <span>Ver Album</span>
                    </a>
                    <div class="mt-2 P-2">
                        @if($cancionesAlbum->first()->imagen)
                            <img src="{{ asset('storage/' . $cancionesAlbum->first()->imagen) }}" alt="imagen álbum">
                        @endif
                    </div>
                    <div class="text-center mt-4">
                      <span class="text">{{ $nombreAlbum }}</span>
                    </div>
                    <!-- <div class="mt-1 text-center">
                      <span>Aqui va el nombre del artista</span>
                    </div> -->
                    <div class="w-full flex mt-5">
                        <audio id="reproductor-{{ $loop->index }}" controls loop preload="metadata"></audio>
                    </div>
                @foreach($cancionesAlbum as $cancion) 
                    <div class="border-b mt-7"></div>
                    
                      <div class="flex justify-between mt-4 items-center">
                        <span>
                          <div class="flex justify-between items-center">
                            <!-- Aqui va el numero de posicion de la cancion -->
                            <!-- <span>1</span> -->
                            <div class="px-2">
                                       <strong>{{ $cancion->nombre }}</strong>
                            </div>
                            <div>
                                    <div>
                                        <button class="hover:text-[#007AB7] text- justify-end flex"s onclick="openModal('{{ $cancion->pk_cancion }}')">
                                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                            </div>
                          </div>                       
                        </span>
                        <div>
                        <button class="hover:text-[#007AB7] justify-end flex" onclick="cambiarCancion('reproductor-{{ $loop->parent->index }}', '{{ asset('storage/' . $cancion->musica) }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.983a1.125 1.125 0 0 1 0 1.966l-5.603 3.113A1.125 1.125 0 0 1 9 15.113V8.887c0-.857.921-1.4 1.671-.983l5.603 3.113Z" clip-rule="evenodd" />
                                </svg>
                        </button> 
                        </div>
                          
                      </div>
                      @endforeach
                  </div>
                    <div class="border-b"></div>
                </div>
                <!-- CARD 1 FIN -->
    @endif
@endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div id="albumModal" class="modal">
    <div class="modal-content">
        <span onclick="closeModal()" class="close">&times;</span>
             <h2 class="text-center text-3xl font-bold">Agrega esta cancion a tus favoritos</h2>
         <div class="justify-center items-center flex flex-col">
            <div class="mt-10 flex flex-col w-[21rem] p-5">

                <form id="favoritaForm" action="{{ route('favorita.store') }}" method="POST">
                    @csrf
                   <div>
                        <input type="hidden" name="fk_cancion" id="fk_cancion">
                   </div>
                    <div>
                        <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}"> 
                    </div>
                   <div class="py-2">
                    <label class="font-semibold" for="fk_album">Álbum al que quieres agregarlo</label>
                    <select class="w-full" name="fk_album" id="fk_album" required>
                        @foreach($albumes as $album)
                            <option value="{{ $album->pk_album }}">{{ $album->nombre_album }}</option>
                        @endforeach
                    </select>
                   </div>
                    <div class="mt-5">
                        <button class="border-[2px] p-2 w-full hover:bg-black hover:text-white border-black" type="submit">Agregar a Favoritas</button>
                   </div>
                </form>
            </div>
        </div>
    </div>
</div>
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


</body>
</html>
