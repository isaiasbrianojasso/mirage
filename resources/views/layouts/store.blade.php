<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tienda Mirage')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Modern styles to give a WOW factor */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="antialiased text-gray-800">
    <!-- Componente de Menú (existente) -->
    <div class="glass-header sticky top-0 z-50 shadow-sm">
        <x-navbar />
    </div>

    <!-- Contenido dinámico principal -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Componente de Footer (existente) -->
    <x-footer />
</body>
</html>
