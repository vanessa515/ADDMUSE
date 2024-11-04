<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Página Principal</title>
</head>
<body>
@include('sidebar')
    <div class="p-4">
        <div class="p-4 mt-14">
            <!-- Mostrar nombre del usuario -->
            @if (Auth::check())
                <h1>Bienvenido, {{ Auth::user()->user_name }}!</h1>
                <hr>
            @endif
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
            <!-- CONTENEDOR DE CARDS -->
            <div class="md:ml-[12rem] p-14 grid-cols-1 md:grid-cols-3 grid md:flex-row gap-10">
            @foreach($canciones as $cancion)
                <!-- CARD 1 -->
                <div class="md:w-[18rem] border border-black rounded-sm mb-10">
                  <div class="p-5">
                    <a href="" class="flex justify-end hover:text-sky-500">
                      <span>Ver Album</span>
                    </a>
                    <div class="mt-2 P-2">
                      <img src="{{ asset('storage/' . $cancion->imagen) }}" alt="Imagen de {{ $cancion->nombre }}" alt="">
                    </div>
                    <div class="text-center mt-4">
                      <span> <!-- aqui va el nombre de la cancion --> </span> 
                    </div>
                    <div class="mt-1 text-center">
                      <span>{{ $cancion->nombre }}</span>
                    </div>
                    <div class="flex w-full mt-6">
                    <audio class="audio" src="{{ asset('storage/' . $cancion->musica) }}" controls loop preload="metadata"></audio>
                    </div>
                    <div class="border-b mt-7"></div>
                      <div class="flex justify-between mt-4 items-center">
                        <a href="" class="flex justify-between hover:text-sky-500">
                          <div class="flex">
                            <span> <!-- aqui va el numero de la cancion dependiendo de cuantas haya --> </span> 
                            <span class="ml-5"><!-- Proximas canciones --></span> 
                          </div>                       
                        </a>
                        <div>
                          <!-- <a class="text-sky-300 hover:text-sky-500" href="" class="justify-end flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                            </svg>
                          </a>  -->
                        </div>
                      </div>
                  </div>
                    <!-- <div class="border-b"></div> -->
                </div>
                @endforeach
                <!-- CARD 1 FIN -->
            </div>
        </div>
        <!-- CONTENEDOR DE CARDS FIN-->
    </div>
@include('fotter')
</body>
</html>
