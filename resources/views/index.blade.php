<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/style.css"> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Questrial&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>INDEX</title>
    
</head>
<body>
@include('sidebar')
<div class="p-4">
    <div class="mt-14">

 
@if (Auth::check())
    <h1>Bienvenido, {{ Auth::user()->user_name }}!</h1>
   
@endif



<script>
        if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('service-worker.js')
          .then((registration) => {
            console.log('Service Worker registrado:', registration);
          })
          .catch((error) => {
            console.log('Error:', error);
          });
      }
    </script>



<h1 class="txt1"> ADDMUSE</h1>

<span class="txt2"> Biblioteca de <br>
     música </span>



<div class="pics" >

<img src="{{ asset('img/sabb.jpeg') }}" alt="Foto de sabrina">


</div>


<a href="/home"><button class="btnexp">Explora Ahora</button></a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="pics2" >
<img src="{{ asset('img/albumm.jpg') }}" alt="tyler">

<span style="font-size: 20px;"> Descubre nuevas <br> canciones </span>
 </div>


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

    </div>
</div>
@include('fotter')
</body>




</html>