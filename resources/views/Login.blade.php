<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
   
<h1>Login</h1>

<form action="{{ route('login.post') }}" method="POST">

@csrf

<input type="text" name="user_name" placeholder="Username" required><br>

<input type="password" name="contraseña" placeholder="Contraseña" required><br>

<button type="submit">Iniciar sesión</button>
<a href="/">Registrate!!</a>

</form>

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
</html>