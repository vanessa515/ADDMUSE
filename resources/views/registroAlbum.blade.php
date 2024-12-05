<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <title>Album</title>
</head>
<body>
@include('sidebar')
<div class="justify-center items-center min-h-screen flex flex-col">
<h1 class="text-center text-3xl font-bold">Agrega un album nuevo</h1>
    <div class="flex flex-col w-[21rem] p-5 shadow-lg border-[2px] border-gray-50 mt-10">
    
        <form action="{{route('album.store')}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="py-2">
            <label class="font-semibold" for="">Nombre del album</label>
            <input class="w-full" type="text" name="nombre_album" placeholder="Introduce el nombre" required>
        </div>
        <div>
            <label class="font-semibold" for="">Imagen del album</label>
            <input class="w-full" type="file" accept=".jpg,.jpeg,.png,.gif" name="imagen" placeholder="nombre" required>
        </div>
        <div class="py-2">
        <label class="font-semibold" for="">Genero musical</label>
        <select class="w-full"  name="fk_categoria" id="fk_categoria" class="form-control" required>
                <option value="" disabled selected>Selecciona una opción</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->pk_categorias }}">
                        {{ $categoria->nombre_cat }} 
                    </option>
                @endforeach
            </select> 
        </div>
            <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}"> 

            <div class="mt-5">
                <button class="border-[2px] p-2 w-full hover:bg-black hover:text-white border-black" type="submit" >Enviar</button>
            </div>

        </form>
    </div>
</div>

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