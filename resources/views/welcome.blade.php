<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<style>
		/* estilos input de imagenes */
		input[type="file"]::file-selector-button {
			background: #007AB7;
		}
		input:hover[type="file"]::file-selector-button {
			background: #0072B2;
		}
</style>
<body>

    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="flex flex-col w-[21rem]">
        <div class="flex justify-center">
            <div class="bg-red-400 opacity-85 blur-md rounded-full w-10 h-10 absolute"></div>
            <div>
                <h1 class="text-center text-4xl font-bold z-50">ADDMUSE</h1>
            </div>
        </div>
        <div class="mt-10">
            <h1 class="text-center text-4xl font-bold">Registrate en</h1>
            <h1 class="text-center text-4xl font-bold">AddMuse</h1>
        </div>
           <div class="mt-10">
                <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex items-center">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <label class="font-semibold ml-1">Nombre de usuario</label>
                        </div>
                        <input class="mt-[2px]" type="text" name="user_name" placeholder="Usuario" required>
                    </div>
                    <div class="flex flex-col py-2">
                        <div class="flex items-center">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <label class="font-semibold ml-1">Correo electronico</label>
                        </div>
                        <input class="mt-[2px]" type="text" name="correo" placeholder="Email" required>
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
                    <div class="flex flex-col pt-2">
                        <div class="flex items-center">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <label class="font-semibold ml-1" for="foto">Imagen de perfil</label>
                        </div>
                        <input class="mt-[2px] border-gray-300 border" type="file" name="foto" accept="image/*" placeholder="Foto">
                    </div>
                    <div class="flex flex-col pt-2">
                    <div class="flex items-center">
                            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            <label class="font-semibold ml-1" for="foto">Confirmar contraseña</label>
                        </div>
                        <input type="password" name="contraseña_confirmation" placeholder="Confirmacion de contraseña" required>
                    </div>
                    <div class="mt-10 flex justify-center">
                        <button class="border border-black p-2 hover:bg-[#007AB7] hover:text-[#FDFEFF] w-full"  type="submit">Guardar</button>
                    </div>
                    <div class="text-center mt-4">
                        <h2>¿Ya tienes una cuenta?</h2>
                        <a class="underline font-semibold hover:text-blue-900" href="login">Inicia sesión</a>
                    </div>
                </form>
           </div>
        </div>
    </div>


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


</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</html>