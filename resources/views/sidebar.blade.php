<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>
        <!-- HEADER -->
        <nav class="fixed top-0 z-50 w-full bg-white">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
              <a href="home" class="flex ms-2 md:me-24">
                <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap">ADDMUSE</span>
              </a>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex gap-10 items-center">
                <div class="md:mr-[5rem]">
                  <a class="text-md font-bold hover:text-sky-800" href="">Sobre Nosotros</a>
                </div>
                <div class="md:mr-[5rem] mr-2">
                  <a class="text-md font-bold hover:text-sky-800" href="vistaAlbum">Musica</a>
                </div>
                <div class="md:flex hidden mr-[2rem]">
                  <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                      </div>
                        <input type="search" id="default-search" class="block w-[20rem] p-4 ps-10 text-sm border border-black bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Buscar" required />
                  </div>
                </div>
              </div>
                <div class="flex items-center ms-3">
                  <div>
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                      <span class="sr-only">Menu de usuario</span>
                      
                  @if($usuarios->isNotEmpty())

@php
    $nombreActual = null; 
@endphp


@foreach($usuarios as $usuario)
                      <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . $usuario->imagen_perfil) }}" alt="user photo">
                    </button>
                  </div>

                  

        @if($nombreActual !== $usuario->Nombre_usuario)
            @php
                $nombreActual = $usuario->Nombre_usuario;
            @endphp
                  <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                      <p class="text-sm text-gray-900" role="none">
                      {{ $usuario->Nombre_usuario }}
                      </p>
                      <p class="text-sm font-medium text-gray-900 truncate" role="none">
                      {{ $usuario->Correo_electronico }}
                      </p>
                    </div>
        
                    @endif
                  
                    @endforeach
                    @endif
                    <ul class="py-1" role="none">
                      <li>
                        <a href="perfil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Perfil</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Favoritos</a>
                      </li>
                      <li>
                      </li>
                      <li>
                          <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                              @csrf
                              <button type="submit">Cerrar sesión</button>
                          </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </nav>
      <div class="md:visible fixed mt-[23rem] right-7 invisible">
        <div class="bg-red-500 rounded-full mb-5">
          <span>prb</span>
        </div>
        <div class="bg-red-500 rounded-full mb-5">
          <span>prb</span>
        </div>
        <div class="bg-red-500 rounded-full">
          <span>prb</span>
        </div>
      </div>
      <!-- HEADER FIN -->
</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</html>

