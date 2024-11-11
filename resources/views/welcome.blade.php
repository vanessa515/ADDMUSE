<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
   
<h1>Registrate</h1>

<form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">

@csrf

   <input type="text" name="user_name" placeholder="Username" required><br>


   <input type="text" name="correo" placeholder="Email" required><br>


   <input type="password" name="contraseña" placeholder="Contraseña" required><br>

   <label for="foto">Subir foto</label><br>
   <input type="file" name="foto" accept="image/*" placeholder="Foto"><br>
   
   <input type="password" name="contraseña_confirmation" placeholder="Confirmacion de contraseña" required><br>

   <a href="login">Iniciar sesión</a><br>

<button type="submit">Guardar</button>
</form>


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
</html>