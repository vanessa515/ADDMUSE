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
<div class="h-screen bg-gray-100 flex items-center justify-center">
    <div class="flex flex-col border p-10 bg-white rounded-sm shadow-lg">
        <h1 class="text-center text-[2.5rem] font-bold items-center">Login</h1>
        <div class="mt-10">
            <form action="{{ route('login.post') }}" method="POST">
            @csrf
                <div class="flex flex-col">
                    <span>Usuario</span>               
                    <input type="text" name="user_name" placeholder="Username" required><br>
                </div>
                <div class="flex flex-col">
                    <span>Contraseña</span>
                    <input type="password" name="contraseña" placeholder="Contraseña" required><br>
                </div>
                <div class="flex justify-center">
                    <button class="text-white bg-blue-500 hover:bg-blue-600 rounded-md text-center p-2 shadow-lg border-black" type="submit">Iniciar sesión</button>
                </div>
                <a href="/">Registrate!!</a>
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