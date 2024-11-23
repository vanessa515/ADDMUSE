<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOBRE NOSOTROS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Questrial&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
@include('sidebar')
<br><br><br><br>
<h1 class="txt3">Sobre nosotros</h1><br><br>

<div class="pic3" id="zoom-scroll"> 

<img src="{{ asset('img/cover.jpg') }}" alt="pic de lana">
</div>

<div class="divp2"> 

<p class="p2">Bienvenido a ADDMUSE, 
    la biblioteca de música donde <br> puedes descubrir nueva música,
     añadir tus canciones favoritas <br> a tu lista de reproducción y 
     subir tus propias creaciones. <br> Aquí en ADDMUSE, 
     estamos comprometidos a proporcionarte <br> la mejor experiencia musical en línea. 
     Nuestro objetivo es conectar a los amantes <br> de la música con artistas talentosos 
     y ofrecer una plataforma para que los músicos <br> compartan su trabajo con el mundo. 
     ¡Únete a nuestra comunidad musical hoy mismo <br> y descubre un mundo de melodías
    y ritmos emocionantes!

</p>
</div>
<script>
    window.addEventListener("scroll", () => {
    const elemento = document.querySelector("#zoom-scroll");
    const scrollY = window.scrollY; // Posición actual del scroll
    const zoomFactor = 1 + scrollY / 1000; // Ajusta este factor según el nivel de zoom deseado

    // Asegura que no se sobrepase un límite razonable
    if (zoomFactor <= 2) {
        elemento.style.transform = `scale(${zoomFactor})`;
    }
});

</script>
<div class="pic4">
    
<img src="{{ asset('img/harry.jpg') }}" alt="pic de harry">
</div>
@include('fotter')
</body>
</html>