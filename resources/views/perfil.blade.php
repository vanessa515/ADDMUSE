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
<div class="p-4">
    <div class="mt-14">
        <!-- INICIO CONTENEDOR -->
        @if($usuarios->isNotEmpty())
            @php
                $usuario = $usuarios->first(); // Obtén solo el primer usuario
            @endphp
        <div class="flex justify-center mt-5">
                <div class="flex flex-col">
                    <div class="bg-[#007AB7] p-10 justify-center w-[70rem]">
                        <div class="flex justify-start">
                            <!-- <span class="hover:bg-red-500">Cambiar foto</span> -->
                        </div>
                        <div class="flex pl-5 mt-10">
                            <div class="flex">
                                <div class="flex w-[10rem] h-[10rem]">
                                    <img class="rounded-full" src="{{ asset('storage/' . $usuario->imagen_perfil) }}" alt="user photo">
                                </div>
                                <div class="flex items-center">
                                    <div class="flex-col">
                                        <p class="text-[#FDFEFF] text-2xl font-bold pl-10">{{ $usuario->Nombre_usuario }}</p>
                                        <div class="mt-3">
                                            <span class="pl-10 text-[#FDFEFF] text-base font-bold">Seguidores <span>0</span></span>
                                            <span class="pl-3 text-[#FDFEFF] text-base font-bold">Siguiendo <span>0</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-center">
                            <button id="editBtn" class="flex text-[#FDFEFF] hover:text-gray-300 group">Editar Perfil
                            <div class="px-2 text-[#FDFEFF] group-hover:text-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </div>
                            </button>
                        </div>
                    </div>
                    <div class=" flex">
                        <a class="px-2" href="">
                            <div class="border-t-4 border-[#007AB7]">
                                <span class="font-semibold text-base text-[#007AB7]">Perfil</span>
                            </div>
                        </a>    
                        <a class="px-2" href="">
                            <div class="border-t-4 border-[#ffffff] hover:border-[#007AB7]">
                                <span class="font-semibold text-base hover:text-[#007AB7]">Favoritos</span>
                            </div>
                        </a>
                        <a class="px-2" href="">
                            <div class="border-t-4 border-[#ffffff] hover:border-[#007AB7]">
                                <span class="font-semibold text-base hover:text-[#007AB7]">Subidas</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endif
@if($favoritas->isNotEmpty())
    @foreach($favoritas as $nombreAlbum => $cancionesAlbum)
<h1>Favoritas</h1>
                <!-- CARD 1 -->
                <div class="md:w-[18rem] border border-black rounded-sm mb-10">
                  <div class="p-5">
                    <a href="" class="flex justify-end hover:text-sky-500">
                      <span>Ver Album</span>
                    </a>
                    <div class="mt-2 P-2">
                        @if($cancionesAlbum->first()->imagen)
                            <img src="{{ asset('storage/' . $cancionesAlbum->first()->imagen) }}" alt="imagen álbum">
                        @endif
                    </div>
                    <div class="text-center mt-4">
                      <span>{{ $nombreAlbum }}</span>
                    </div>
                    <div class="mt-1 text-center">
                      <span>Aqui va el nombre del artista</span>
                    </div>
                    <div class="w-full flex mt-5">
                        <audio id="reproductor-{{ $loop->index }}" controls loop preload="metadata"></audio>
                    </div>
                    
                    <div class="border-b mt-7"></div>
                    @foreach($cancionesAlbum as $cancion)
                      <div class="flex justify-between mt-4 items-center">
                        <span>
                          <div class="flex">
                            <!-- Aqui va el numero de posicion de la cancion -->
                            <!-- <span>1</span> -->
                            <spans>{{ $cancion->nombre }}</span>
                          </div>                       
                        </span>
                        <div>
                        <button class="hover:text-[#007AB7] justify-end flex" onclick="cambiarCancion('reproductor-{{ $loop->parent->index }}', '{{ asset('storage/' . $cancion->musica) }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                            </svg>
                        </button> 
                        </div>
                      </div>
                  </div>
                    <div class="border-b"></div>
                    @endforeach
                </div>
                <!-- CARD 1 FIN -->
                @endforeach
            @else
        <!-- Reproductor de música para este álbum -->

        
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
