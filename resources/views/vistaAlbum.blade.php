<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albumes</title>
</head>
<body>

<h1>Albumes</h1>

@foreach($albumes as $album)

    <h2>{{ $album->nombre_album }}</h2>
    <img style="width: 200px; height: 200px" src="{{ asset('storage/' . $album->imagen) }}" alt="imagen-album">


@endforeach

</body>
</html>