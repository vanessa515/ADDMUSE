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
                <!-- Logo -->
                <div class="flex items-center justify-start rtl:justify-end">
                    <a href="{{ route('index') }}" class="flex ms-2 md:me-24">
                        <span class="self-center text-xl font-bold sm:text-2xl whitespace-nowrap">ADDMUSE</span>
                    </a>
                </div>

                <!-- Navigation Links and Search -->
                <div class="flex items-center justify-between">
                    <div class="flex gap-10 items-center">
                    <div class="md:mr-[5rem]">
                            <a class="text-md font-bold hover:text-sky-800" href="{{ route('home') }}"> Explorar</a>
                            
                        </div>
                        <div class="md:mr-[5rem]">
                            <a class="text-md font-bold hover:text-sky-800" href="{{ route('sobrenosotros') }}">Sobre Nosotros</a>
                        </div>
                        <div class="md:mr-[5rem] mr-2">
                            <a class="text-md font-bold hover:text-sky-800" href="{{ route('vistaAlbum') }}"  >Tu musica</a>
                        </div>






                    <!-- User Menu -->
                    <div class="flex items-center ms-3">
                        @if($usuarios->isNotEmpty())
                            @php
                                $usuario = $usuarios->first(); // Obtén solo el primer usuario
                            @endphp
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Menu de usuario</span>
                                <img class="w-8 h-8 rounded-full" src="{{ asset('storage/' . $usuario->imagen_perfil) }}" alt="user photo">
                            </button>

                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900" role="none">{{ $usuario->Nombre_usuario }}</p>
                                    <p class="text-sm font-medium text-gray-900 truncate" role="none">{{ $usuario->Correo_electronico }}</p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('perfil') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Perfil</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Favoritos</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                            @csrf
                                            <button type="submit">Cerrar sesión</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Floating Action Buttons -->
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
    <!-- HEADER END -->

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
