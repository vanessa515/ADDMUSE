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
<input type="file" accept=".jpg,.jpeg,.png,.gif" name="imagen" placeholder="nombre" required><br>
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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

</body>
</html>