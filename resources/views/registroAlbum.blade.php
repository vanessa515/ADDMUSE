<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
</head>
<body>
    
<h1>Albumes</h1>


<form action="{{route('album.store')}}" method="POST" enctype="multipart/form-data">

@csrf

<input type="text" name="nombre_album" placeholder="nombre" required><br>

<label for="">Imagen</label><br>
<input type="file" name="imagen" placeholder="nombre" required><br>
<select name="fk_categoria" id="fk_categoria" class="form-control" required><br>
        <option value="" disabled selected>Selecciona una opción</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->pk_categorias }}">
                {{ $categoria->nombre_cat }} 
            </option>
        @endforeach
    </select> <br>
    <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}"> 
    <button type="submit" >Enviar</button>

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