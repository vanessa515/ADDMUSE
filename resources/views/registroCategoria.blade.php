<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro categorias</title>
</head>
<body>

<h1> Registra categorias </h1>
    
<form action="{{ route('regcat.store') }}" method="POST">

@csrf


<input type="text" name="nombre" placeholder="Nombre de la categoria" required><br>

<button type="submit"> Guardar </button>

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