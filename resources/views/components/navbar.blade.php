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

            <!-- Navegación Principal y Buscador -->
            <div class="hidden md:flex flex-1 items-center justify-between ml-8 mr-6">
                <nav class="flex space-x-6">
                    <a href="{{ route('tienda.index') }}" class="text-gray-700 hover:text-indigo-600 px-2 py-2 rounded-md text-sm font-semibold transition-colors {{ request()->routeIs('tienda.index') ? 'text-indigo-600' : '' }}">
                        Catálogo
                    </a>
                </nav>

                <!-- Buscador con Autocompletado -->
                <div class="relative w-full max-w-lg ml-6" id="autocomplete-container">
                    <form action="{{ route('search.index') }}" method="GET" class="relative">
                        <input type="text" name="q" id="search-input" autocomplete="off" placeholder="Buscar productos..." class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm bg-gray-50/50">
                        <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                    
                    <!-- Dropdown de Resultados -->
                    <div id="search-results" class="absolute w-full mt-2 bg-white border border-gray-100 rounded-xl shadow-xl z-50 hidden overflow-hidden">
                        <div id="search-results-list" class="divide-y divide-gray-100 max-h-96 overflow-y-auto">
                            <!-- Resultados inyectados por JS -->
                        </div>
                        <div id="search-loading" class="p-4 text-center text-gray-500 text-sm hidden">
                            Buscando...
                        </div>
                    </div>
                </div>
            </div>

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

                <!-- Icono de Lista de Deseos -->
                <a href="{{ route('wishlist.index') }}" class="relative p-2 text-gray-600 hover:text-indigo-600 transition-colors group" title="Lista de deseos">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <!-- Puedes agregar el contador de wishlist aquí si lo deseas -->
                </a>

                <!-- Icono de Carrito -->
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 hover:text-indigo-600 transition-colors group" title="Carrito">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    const searchResultsList = document.getElementById('search-results-list');
    const searchLoading = document.getElementById('search-loading');
    let timeoutId;

    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        
        clearTimeout(timeoutId);

        if (query.length < 2) {
            searchResults.classList.add('hidden');
            return;
        }

        searchResults.classList.remove('hidden');
        searchResultsList.innerHTML = '';
        searchLoading.classList.remove('hidden');

        timeoutId = setTimeout(() => {
            fetch(`/buscar/autocomplete?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchLoading.classList.add('hidden');
                    searchResultsList.innerHTML = '';
                    
                    if (data.length === 0) {
                        searchResultsList.innerHTML = '<div class="p-4 text-sm text-gray-500 text-center">No se encontraron productos.</div>';
                        return;
                    }

                    data.forEach(product => {
                        const html = `
                            <a href="${product.url}" class="flex items-center p-3 hover:bg-gray-50 transition-colors group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-md overflow-hidden">
                                    ${product.image ? `<img src="${product.image}" class="w-full h-full object-cover">` : `<div class="w-full h-full flex items-center justify-center text-gray-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>`}
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">${product.name}</div>
                                    <div class="text-sm font-bold text-red-500 mt-0.5">${product.price}</div>
                                </div>
                                <div class="text-xs text-gray-400 font-medium tracking-wide">
                                    Producto
                                </div>
                            </a>
                        `;
                        searchResultsList.insertAdjacentHTML('beforeend', html);
                    });
                })
                .catch(error => {
                    searchLoading.classList.add('hidden');
                    console.error('Error fetching search results:', error);
                });
        }, 300); // 300ms debounce
    });

    // Ocultar al hacer clic fuera
    document.addEventListener('click', function(e) {
        if (!document.getElementById('autocomplete-container').contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });
});
</script>
