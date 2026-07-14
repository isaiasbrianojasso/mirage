@include('components.x-header')
<body class="archive tax-product_cat wp-theme-genesis wp-child-theme-digital-pro theme-genesis woocommerce woocommerce-page woocommerce-no-js custom-header header-image header-full-width full-width-content genesis-breadcrumbs-hidden genesis-footer-widgets-visible elementor-default" itemscope itemtype="https://schema.org/WebPage">
<div class="site-container">
    @include('components.x-menu')
    <ul class="genesis-skip-link">
        <li><a href="#genesis-content" class="screen-reader-shortcut"> Saltar al contenido principal</a></li>
        <li><a href="#genesis-footer-widgets" class="screen-reader-shortcut"> Saltar al pie de página</a></li>
    </ul> 
    <div class="site-inner">
        <div class="content-sidebar-wrap">
            <main class="content" id="genesis-content">
                <div class="archive-description taxonomy-archive-description taxonomy-description text-center" style="margin-bottom: 40px; margin-top: 20px;">
                    <h1 class="archive-title" style="font-size: 32px; font-weight: 700; color: #222;">Todos los Productos {{ $businessSetting->name ?? 'Mirage' }}</h1>
                </div>
                <div class="woocommerce-notices-wrapper"></div>
                
                @if(isset($rootCategories) && $rootCategories->count() > 0)
                <ul class="products columns-5">
                    @foreach($rootCategories as $index => $category)
                    <li class="product-category product {{ $index % 5 == 0 ? 'first' : '' }} {{ ($index + 1) % 5 == 0 ? 'last' : '' }}">
                        <a aria-label="Visitar la categoría de producto {{ $category->name }}" href="{{ route('catalogo.category', ['slug' => $category->uuid]) }}">
                            <img src="{{ $category->representative_image }}" alt="{{ $category->name }}" width="500" height="500" onerror="this.onerror=null; this.src='/tienda_assets/img/p/mx-default-home_default.jpg'" style="width: 100%; height: auto; aspect-ratio: 1; object-fit: cover;" />
                            <h2 class="woocommerce-loop-category__title">
                                {{ $category->name }} <mark class="count">({{ $category->products_count ?? 0 }})</mark>
                            </h2>
                        </a>
                    </li>
                    @endforeach
                </ul>
                @else
                <div class="text-center" style="padding: 40px;">
                    <p>No hay categorías disponibles en este momento.</p>
                </div>
                @endif
            </main>
        </div>
    </div>
    
    @include('components.x-legacy-footer')
</div>
</body>
</html>
