<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mirage México – Marca especializada en aires acondicionados y línea blanca.</title>
    <meta name="description" content="La principal marca de aires acondicionados tipo minisplit, líder nacional en ventas.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <a href="#" class="back-to-top" id="backToTop">↑</a>
    
</body>
</html>
