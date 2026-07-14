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
                    <h1 class="archive-title" style="font-size: 32px; font-weight: 700; color: #222;">{{ $category->name }}</h1>
                    @if($category->description)
                        <p>{{ $category->description }}</p>
                    @endif
                </div>
                <div class="woocommerce-notices-wrapper"></div>
                
                @if($subcategories->isNotEmpty())
                    <ul class="products columns-5">
                        @foreach($subcategories as $index => $sub)
                        <li class="product-category product {{ $index % 5 == 0 ? 'first' : '' }} {{ ($index + 1) % 5 == 0 ? 'last' : '' }}">
                            <a aria-label="Visitar la categoría de producto {{ $sub->name }}" href="{{ route('catalogo.category', ['slug' => $sub->slug ?? $sub->uuid]) }}">
                                <img src="{{ Str::startsWith($sub->representative_image, 'http') ? $sub->representative_image : asset($sub->representative_image) }}" alt="{{ $sub->name }}" width="500" height="500" onerror="this.onerror=null;this.src='/tienda_assets/img/p/mx-default-home_default.jpg';" style="width: 100%; height: auto; aspect-ratio: 1; object-fit: cover;" />
                                <h2 class="woocommerce-loop-category__title">
                                    {{ $sub->name }} <mark class="count">({{ $sub->products_count ?? 0 }})</mark>
                                </h2>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @elseif($products->isNotEmpty())
                    <ul class="products columns-4">
                        @foreach($products as $index => $product)
                        <li class="product type-product status-publish has-post-thumbnail {{ $index % 4 == 0 ? 'first' : '' }} {{ ($index + 1) % 4 == 0 ? 'last' : '' }}">
                            <a href="{{ route('catalogo.product', ['slug' => $product->slug ?? $product->id]) }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                @php
                                  $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                                  $imageUrl = $primaryImage ? (Str::startsWith($primaryImage->image_url, 'http') ? $primaryImage->image_url : Storage::url($primaryImage->image_url)) : '/tienda_assets/img/p/mx-default-home_default.jpg';
                                @endphp
                                <img src="{{ $imageUrl }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="{{ $product->name }}" decoding="async" loading="lazy" style="width: 100%; height: auto; aspect-ratio: 1; object-fit: cover;" onerror="this.onerror=null;this.src='/tienda_assets/img/p/mx-default-home_default.jpg';" />
                                <h2 class="woocommerce-loop-product__title" style="font-size: 16px; margin-top: 15px;">{{ $product->name }}</h2>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center" style="padding: 40px;">
                        <p>No hay productos disponibles en esta categoría en este momento.</p>
                    </div>
                @endif
            </main>
        </div>
    </div>
    
    @include('components.x-legacy-footer')
</div>
</body>
</html>
