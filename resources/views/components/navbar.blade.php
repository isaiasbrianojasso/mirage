<header class="bg-[#3f3f42] text-white">
    <div class="max-w-[1280px] mx-auto px-3 py-4 flex items-center gap-4">
        <a href="{{ route('tienda.index') }}" class="shrink-0">
            <img src="{{ company_logo() }}" alt="{{ company_name() }}" class="w-auto h-10" />
        </a>

        <div class="justify-center flex-1 hidden md:flex" id="autocomplete-container">
            <form action="{{ route('search.index') }}" method="GET" class="w-full max-w-[520px] relative">
                <input
                    type="text"
                    name="q"
                    id="search-input"
                    autocomplete="off"
                    placeholder="Buscar productos..."
                    class="w-full h-10 px-4 pr-10 text-sm text-gray-800 bg-white border border-gray-300"
                >
                <button type="submit" class="absolute text-gray-700 -translate-y-1/2 right-3 top-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
            <div id="search-results" class="absolute mt-11 w-full max-w-[520px] bg-white text-gray-900 border border-gray-200 shadow-xl z-50 hidden">
                <div id="search-results-list" class="overflow-y-auto max-h-80"></div>
                <div id="search-loading" class="hidden p-3 text-sm text-gray-500">Buscando...</div>
            </div>
        </div>

        <div class="flex items-center gap-6 ml-auto text-sm">
            <a href="{{ route('dashboard') }}" class="hover:text-gray-200">Mi Cuenta</a>
            <a href="{{ route('cart.index') }}" class="hover:text-gray-200">Carrito ({{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }})</a>
        </div>
    </div>

    <nav class="bg-[#2f2f31] border-t border-white/10">
        <div class="max-w-[1280px] mx-auto px-3 h-11 flex items-center justify-center gap-10 text-sm font-semibold uppercase tracking-wide">
            <a href="{{ route('tienda.index') }}" class="hover:text-gray-200">Inicio</a>
            <a href="{{ route('tienda.index') }}" class="hover:text-gray-200">Productos</a>
            <a href="{{ route('tienda.contact') }}" class="hover:text-gray-200">Contacto</a>
        </div>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');
    const searchResultsList = document.getElementById('search-results-list');
    const searchLoading = document.getElementById('search-loading');

    if (!searchInput || !searchResults || !searchResultsList || !searchLoading) {
        return;
    }

    let timeoutId;

    searchInput.addEventListener('input', function (e) {
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
                .then((response) => response.json())
                .then((data) => {
                    searchLoading.classList.add('hidden');
                    searchResultsList.innerHTML = '';

                    if (!data.length) {
                        searchResultsList.innerHTML = '<div class="p-3 text-sm text-center text-gray-500">No se encontraron productos.</div>';
                        return;
                    }

                    data.forEach((product) => {
                        searchResultsList.insertAdjacentHTML('beforeend', `
                            <a href="${product.url}" class="block p-3 border-b border-gray-100 hover:bg-gray-50">
                                <div class="text-sm font-semibold">${product.name}</div>
                                <div class="text-sm text-red-600">${product.price}</div>
                            </a>
                        `);
                    });
                })
                .catch(() => {
                    searchLoading.classList.add('hidden');
                });
        }, 250);
    });

    document.addEventListener('click', function (e) {
        const container = document.getElementById('autocomplete-container');
        if (container && !container.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });
});
</script>
