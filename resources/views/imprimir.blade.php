<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/test.css">
    <title>Estructura de control e impresion de datos</title>
</head>
<body>
    <h1>Estructura de control e impresion de datos</h1>

    @if ($nombre == "Lalo")
        <p>Welcome {{ $nombre }} </p>
    @else
        <p>Usuario desconocidi</p>
    @endif  

    <hr>

    <ul>
        @foreach( $marcas as $marca)
        <li> {{ $marca }} </li>
        @endForeach
    </ul>
    
</body>
</html>