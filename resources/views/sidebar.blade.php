<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="apple-touch-icon" href="{{ asset('icono.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <!-- HEADER -->
    <nav class="fixed top-0 z-50 w-full bg-white">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <a href="{{ route('index') }}" class="flex ms-2 md:me-24">
                    <div class="flex justify-center">
                        <div class="bg-red-400 opacity-65 blur-sm rounded-full w-5 h-5 absolute"></div>
                        <div>
                            <h1 class="text-center text-xl font-bold z-50">ADDMUSE</h1>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex gap-10 items-center">
                        <div class="md:mr-[5rem] md:flex hidden">
                            <a class="text-md font-bold hover:text-sky-800" href="{{ route('home') }}"> Explorar</a>  
                        </div>
                        <div class="md:mr-[5rem] md:flex hidden">
                            <a class="text-md font-bold hover:text-sky-800" href="{{ route('sobrenosotros') }}">Sobre nosotros</a>
                        </div>
                        <div class="md:mr-[5rem] md:flex hidden">
                            <a class="text-md font-bold hover:text-sky-800" href="{{ route('vistaAlbum') }}">Tu musica</a>
                        </div>
                    <div class="flex items-center ms-3">
                            <button type="button" class="flex text-sm hover:text-blakc md:hidden mr-5 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user2">
                                <span class="sr-only">Menu de usuario</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user2">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900" role="none"></p>
                                    <p class="text-sm font-medium text-gray-900 truncate" role="none"></p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Explora</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sobrenosotros') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sobre nosotros</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('vistaAlbum') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Tu musica</a>
                                    </li>
                                </ul>
                            </div>
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
                                        <a href="registroAlbum" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Registra un album</a>
                                    </li>
                                    <li>
                                        <a href="registrocan" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Registra una cancion</a>
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
    <!-- <div class="md:visible fixed mt-[23rem] right-7 invisible">
        <div class="bg-red-500 rounded-full mb-5">
            <span>prb</span>
        </div>
        <div class="bg-red-500 rounded-full mb-5">
            <span>prb</span>
        </div>
        <div class="bg-red-500 rounded-full">
            <span>prb</span>
        </div>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
