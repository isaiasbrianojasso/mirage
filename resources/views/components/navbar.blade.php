<header class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('tienda.index') }}" class="flex items-center gap-2">
                    <span class="text-3xl font-black text-indigo-700 tracking-tighter">MIRAGE</span>
                    <span class="text-sm font-semibold text-gray-500 uppercase tracking-widest mt-1">Store</span>
                </a>
            </div>

            <!-- Navegación Principal -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('tienda.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-semibold transition-colors {{ request()->routeIs('tienda.index') ? 'text-indigo-600' : '' }}">
                    Catálogo
                </a>
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-semibold transition-colors {{ request()->routeIs('cart.index') ? 'text-indigo-600' : '' }}">
                    Carrito
                </a>
            </nav>

            <!-- Autenticación y Carrito -->
            <div class="hidden md:flex items-center space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition-colors">
                        Mi Cuenta
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-indigo-600 transition-colors">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all hover:shadow-md hover:-translate-y-0.5">
                        Registrarse
                    </a>
                @endauth

                <!-- Icono de Carrito -->
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-indigo-600 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @php
                        $cartCount = 0;
                        if(session()->has('cart')) {
                            foreach(session('cart') as $item) {
                                $cartCount += $item['quantity'];
                            }
                        }
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white shadow-sm translate-x-1/4 -translate-y-1/4">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Botón Menú Móvil -->
            <div class="flex items-center md:hidden">
                <button type="button" class="text-gray-600 hover:text-indigo-600 focus:outline-none p-2">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
