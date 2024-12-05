<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>
    <!-- FOTTER -->
    <div class="p-4">
        <div class="p-4 md:p-14">
          <div>
            <span class="text-xl font-normal">Encuentra a tus artista favoritos</span>
          </div>
          <div class="border-b mt-2 border-black"></div>
          <div class="flex justify-between mt-10 p-4 md:px-7">
            <div class="flex flex-col text-base font-medium">
                <div class="py-2" href="">Sube tus canciones</div>
                <div class="py-2" href="">Agrega tus canciones favoritas</div>
            </div>
            <div class="flex flex-col">
              <span class="font-normal text-xl py-2">¿Alguna sugerencia?</span>
              <span class="font-medium py-2">ADD MUSE</span>
              <span class="font-medium">addmusecontact@gmail.com</span>
              <span class="font-medium py-2">6941012233</span>
            </div> 
          </div>
          <div class="flex justify-end mt-14 p-4 md:px-7">
            <a href="registrocat">©2024 By ADDMUSE</a>
          </div>
        </div>
      </div>
    <!-- FOTTER FIN -->
</body>
</html>