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
                        <a href="#" class="btn-iqitwishlist-add js-iqitwishlist-add" data-id-product="{{ $product->id }}" data-toggle="tooltip" title="Añadir a mi lista de deseos">
                            <i class="fa fa-heart-o not-added" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="btn-iqitcompare-add js-iqitcompare-add" data-id-product="{{ $product->id }}" data-toggle="tooltip" title="Comparar">
                            <i class="fa fa-random" aria-hidden="true"></i>
                        </a>
                        <a class="js-quick-view-iqit" href="#" data-id-product="{{ $product->id }}" data-toggle="tooltip" title="Vista rápida">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="product-description">
                <div class="product-category-name text-muted">{{ $product->category ? $product->category->name : "General" }}</div>    
                <h3 class="h3 product-title">
                    <a href="{{ route("tienda.product", $product->slug) }}">{{ $product->name }}</a>
                </h3>
                <div class="product-reference text-muted"> <a href="{{ route("tienda.product", $product->slug) }}">{{ $product->sku }}</a></div>    
                <div class="product-price-and-shipping">
                    <a href="{{ route("tienda.product", $product->slug) }}"> <span class="price">${{ number_format($product->price, 2) }}</span></a>
                </div>
                <div class="product-add-cart">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button class="btn btn-primary btn-sm add-to-cart" type="submit">
                            <i class="fa fa-shopping-bag fa-fw bag-icon" aria-hidden="true"></i>
                            <span class="btn-title">Añadir al carrito</span>
                        </button>
                    </form>
                </div>
            </div>
        </article>
    </div>
</div>
