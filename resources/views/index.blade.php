<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
</head>
<body>
@include('sidebar')
<br><br><br>
@if (Auth::check())
    <h1>Bienvenido, {{ Auth::user()->user_name }}!</h1>
    <hr>
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

<br><br><br>
<a href="/home"><button>Explora Ahora</button></a>


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


@include('fotter')
</body>
</html>