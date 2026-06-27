<?php
$index = file_get_contents('resources/views/tienda/index.blade.php');

$dynamic_products = '
                <div class="swiper-wrapper">
                    @foreach($featuredProducts as $product)
                    <div class="swiper-slide"> 
                        <div class="js-product-miniature-wrapper product-carousel ">
                            <article class="product-miniature product-miniature-default product-miniature-grid product-miniature-layout-1 js-product-miniature" data-id-product="{{ $product->id }}">
                                <div class="thumbnail-container">
                                    <a href="{{ route("tienda.product", $product->slug) }}" class="thumbnail product-thumbnail">
                                        @if($product->images->count() > 0)
                                        <img src="{{ Str::startsWith($product->images->first()->image_url, "http") ? $product->images->first()->image_url : Storage::url($product->images->first()->image_url) }}" alt="{{ $product->name }}" class="img-fluid lazy-product-image product-thumbnail-first">
                                        @if($product->images->count() > 1)
                                        <img src="{{ Str::startsWith($product->images[1]->image_url, "http") ? $product->images[1]->image_url : Storage::url($product->images[1]->image_url) }}" alt="{{ $product->name }}" class="img-fluid lazy-product-image product-thumbnail-second">
                                        @endif
                                        @else
                                        <div style="height: 305px; display: flex; align-items: center; justify-content: center; background: #f5f5f5;"><i class="fa fa-image" style="font-size: 48px; color: #ccc;"></i></div>
                                        @endif
                                    </a>
                                    <div class="product-functional-buttons product-functional-buttons-bottom">
                                        <div class="product-functional-buttons-links">
                                            <form action="{{ route("cart.add") }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-iqitwishlist-add" style="border: none; background: transparent; cursor: pointer; color: #333;" title="Añadir al carrito"><i class="fa fa-shopping-cart"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-description">
                                    <div class="product-category-name text-muted">{{ $product->category ? $product->category->name : "General" }}</div>    
                                    <h2 class="h3 product-title">
                                        <a href="{{ route("tienda.product", $product->slug) }}">{{ $product->name }}</a>
                                    </h2>
                                    <div class="product-reference text-muted"> <a href="{{ route("tienda.product", $product->slug) }}">{{ $product->sku }}</a></div>    
                                    <div class="product-price-and-shipping">
                                        <a href="{{ route("tienda.product", $product->slug) }}"> <span class="product-price">${{ number_format($product->price, 2) }}</span></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    @endforeach
                </div>
';

// PRODUCTOS DESTACADOS
$pos1 = strpos($index, 'PRODUCTOS DESTACADOS');
if ($pos1 !== false) {
    $wrapperStart = strpos($index, '<div class="swiper-wrapper">', $pos1);
    // Use the navigation button as the end marker since products dont have pagination
    $wrapperEnd = strpos($index, '<div class="swiper-button-prev swiper-button', $wrapperStart);
    
    if ($wrapperStart !== false && $wrapperEnd !== false) {
        $part1 = substr($index, 0, $wrapperStart);
        // Ensure we don\'t miss any closing divs between swiper-wrapper end and swiper-button-prev
        // Actually, the original HTML is: </div> </div> </div> </div> <div class="swiper-button-prev"
        // Let\'s just find the closing </div> of swiper-wrapper.
        // It\'s better to just replace EVERYTHING from `<div class="swiper-wrapper">` until `<div class="swiper-button-prev`.
        $part2 = substr($index, $wrapperEnd);
        $index = $part1 . $dynamic_products . "\n                                        </div>\n                                        </div>\n                                    " . $part2;
    }
}

// NUEVOS PRODUCTOS
$pos2 = strpos($index, 'NUEVOS PRODUCTOS');
if ($pos2 !== false) {
    $wrapperStart2 = strpos($index, '<div class="swiper-wrapper">', $pos2);
    $wrapperEnd2 = strpos($index, '<div class="swiper-button-prev swiper-button', $wrapperStart2);
    
    if ($wrapperStart2 !== false && $wrapperEnd2 !== false) {
        $part1 = substr($index, 0, $wrapperStart2);
        $part2 = substr($index, $wrapperEnd2);
        $index = $part1 . $dynamic_products . "\n                                        </div>\n                                        </div>\n                                    " . $part2;
    }
}

// BANNERS
$dynamic_banners = '
<div class="swiper-wrapper">
    @foreach($banners as $banner)
    <div class="swiper-slide">
        <div class="swiper-slide-inner">
            <a href="{{ $banner->link ?? \'#\' }}">
                <img class="swiper-slide-image" src="{{ Str::startsWith($banner->image_url, "http") ? $banner->image_url : Storage::url($banner->image_url) }}" alt="{{ $banner->title }}" style="width: 100%; height: auto;" />
            </a>
        </div>
    </div>
    @endforeach
</div>
';

// Find the first banner slider wrapper
$bannerStart = strpos($index, '<div class="swiper-wrapper">');
if ($bannerStart !== false) {
    // Banner actually DOES have swiper-dots-outside in the original HTML!
    $bannerEnd = strpos($index, '<div class="swiper-pagination elementor-swiper-pagination swiper-dots-outside"></div>', $bannerStart);
    if ($bannerEnd !== false) {
        $part1 = substr($index, 0, $bannerStart);
        $part2 = substr($index, $bannerEnd);
        $index = $part1 . $dynamic_banners . "\n                                    " . $part2;
    }
}

file_put_contents('resources/views/tienda/index.blade.php', $index);
echo "Injected dynamic content successfully using strpos!\n";
