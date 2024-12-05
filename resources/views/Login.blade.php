<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="apple-touch-icon" href="{{ asset('icono.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>
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

<div class="flex">
    <div class="hidden  md:flex md:w-[40%]">
        <div class="w-full h-full">
            <img src="{{ asset('img/TRAV.jpg') }}" class="h-screen w-full" alt="">
        </div>
    </div>
    <div class="md:w-[60%] md:shadow-lg w-[100%]">
   <div class="flex justify-center items-center min-h-screen">
    <div class="flex flex-col w-[21rem]">
        <div class="flex justify-center">
            <div class="bg-red-400 opacity-85 blur-md rounded-full w-10 h-10 absolute"></div>
            <div>
                <h1 class="text-center text-4xl font-bold z-50">ADDMUSE</h1>
            </div>
        </div>
        <div class="mt-10">
            <h1 class="text-center text-3xl font-bold">Inicia sesion en</h1>
            <h1 class="text-center text-3xl font-bold">ADDMUSE</h1>
        </div>
        <div class="mt-10">
            <form action="{{ route('login.post') }}" method="POST">
            @csrf
                <div class="flex flex-col py-2">
                    <div class="flex items-center">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <label class="font-semibold ml-1">Nombre de usuario</label>
                    </div>
                    <input class="mt-[2px]" type="text" name="user_name" placeholder="Usuario" required>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center">
                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <label class="font-semibold ml-1">Contraseña</label>
                    </div>
                    <input class="mt-[2px]" type="password" name="contraseña" placeholder="Contraseña" required>
                </div>
                <div class="mt-10 flex justify-center">
                    <button class="border-[2px] p-2 w-full hover:bg-black hover:text-white border-black" type="submit">Iniciar sesión</button>
                </div>
                <div class="text-center mt-4">
                    <h2>¿No tienes una cuenta?</h2>
                    <a class="underline font-semibold hover:text-blue-900" href="/">Registrate!!</a>
                </div>
            </form>
        </div>
    </div>
   </div>
</div>
</div>

<!-- Mostrar errores de validación -->
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Mostrar mensaje de éxito si existe -->
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif


</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</html>