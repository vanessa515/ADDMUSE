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
            background-color: rgb(0,0,0);
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


@if($usuarios->isNotEmpty())
    @php
        $nombreActual = null; 
    @endphp

    @foreach($usuarios as $usuario)
        @if($nombreActual !== $usuario->Nombre_usuario)
            @php
                $nombreActual = $usuario->Nombre_usuario;
            @endphp
    <div class="p-4">
        <div class="border-2 border-gray-200 border-dashed rounded-lg mt-14">
            <!-- INICIO CONTENEDOR -->
            <div class="flex justify-center mt-5">
                <div class="flex flex-col">
                    <div class="bg-[#007AB7] p-10 justify-center w-[70rem]">
                        <div class="flex justify-start">
                            <span class="hover:bg-red-500">Cambiar foto</span>
                        </div>
                        <div class="flex pl-5 mt-10">
                            <div class="flex">
                                <div class="flex w-[10rem] h-[10rem]">
                                    <img class="rounded-full" src="{{ asset('storage/' . $usuario->imagen_perfil) }}" alt="">
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
                        <div class="flex justify-end">
                            <button id="editBtn">Editar Nombre</button>
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
            <h1>Favoritas</h1><br>

            @foreach($favoritas as $favorita)
                <h2>{{ $favorita->nombre_album }}</h2><br>
                <h2>{{ $favorita->nombre }}</h2><br>
                <img style="width: 200px; height: 200px" src="{{ asset('storage/' . $favorita->imagen) }}" alt=""><br>
                <audio src="{{ asset('storage/' . $favorita->musica) }}" controls loop preload="metadata"></audio>
            @endforeach

            <h1>Musicas</h1>  
        @endif

        @if($usuario->musica)
            <img src="{{ asset('storage/' . $usuario->imagen) }}" style="max-width: 150px;"><br>
            <h2>{{ $usuario->Musica }}</h2>
            <h2>{{ $usuario->fecha }}</h2>
            <audio class="audio" src="{{ asset('storage/' . $usuario->musica) }}" controls loop preload="metadata"></audio> <br>
        @else
            <p>No hay música cargada de este usuario.</p>
        @endif
    @endforeach

@else
    <p>No hay información disponible.</p>
@endif
        <!-- FIN DEL CONTENEDOR PADDING -->
    </div>
</div>
@include('fotter')


<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Nombre de Usuario</h2>
        <form action="{{ route('perfil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="user_name">
                <input type="text" name="user_name" value="{{ old('user_name', $info->user_name) }}" required>
            </label>

            <button type="submit">Actualizar</button>
        </form>
    </div>
</div>
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
</script>

</body>
</html>
