<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>
   


<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="flex flex-col">
        <div>
            <!-- LOGOMUSE -->
        </div>
        <h1 class="text-center text-4xl font-bold">Inicia sesion en</h1>
        <h1 class="text-center text-4xl font-bold">AddMuse</h1>
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
                    <button class="border border-black p-2 hover:bg-[#007AB7] hover:text-[#FDFEFF] w-full" type="submit">Iniciar sesión</button>
                </div>
                <div class="text-center mt-4">
                    <h2>¿No tienes una cuenta?</h2>
                    <a class="underline font-semibold hover:text-blue-900" href="/">Registrate!!</a>
                </div>
            </form>
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