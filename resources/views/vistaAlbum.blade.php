<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Albumes</title>
</head>
<body>

    <div class="p-4">
        <div class="border-2 border-gray-200 border-dashed rounded-lg mt-14">
            <!-- INICIO CONTENEDOR -->
            <div class="grid-cols-1 md:grid-cols-4 grid md:flex-row">
                <!-- CARD 1 -->
                @foreach($albumes as $album)
                <div class="p-2">
                  <a href="" class="flex hover:p-[3px] hover:blur-[1px] flex-col hover:opacity-70">
                    <div class="mt-2 P-2">
                        <h2>{{ $album->nombre_album }}</h2>
                        <img src="{{ asset('storage/' . $album->imagen) }}" alt="imagen-album">
                    </div>
                  </a>
                  <div class="bg-black w-full h-[5rem]">a</div>
                </div>
                @endforeach
                <!-- CARD 1 FIN -->
              </div>
        </div>
    </div>

</body>
</html>