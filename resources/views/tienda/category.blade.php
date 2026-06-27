@extends('layouts.tienda')

@section('content_class', 'page-category')

@section('content')
<div class="row">
    <!-- Sidebar izquierdo recuperado -->
    <div id="left-column" class="col-12 col-md-3 col-lg-2 order-first">
        <div class="block block-toggle block-categories block-links js-block-toggle">
            <h5 class="block-title"><span><a href="{{ route('tienda.index') }}">Inicio</a></span></h5>
            <div class="category-top-menu block-content">
                <ul class="category-sub-menu">
                    <li data-depth="0"><a href="{{ route('tienda.category', 'refacciones') }}">Refacciones</a></li>
                    <li data-depth="0"><a href="{{ route('tienda.category', 'aire-acondicionado') }}">Aire Acondicionado</a></li>
                    <li data-depth="0"><a href="{{ route('tienda.category', 'linea-blanca') }}">Línea Blanca</a></li>
                    <li data-depth="0"><a href="{{ route('tienda.category', 'herramientas') }}">Herramientas</a></li>
                    <li data-depth="0"><a href="{{ route('tienda.category', 'souvenirs') }}">Souvenirs</a></li>
                    <li data-depth="0"><a href="{{ route('tienda.category', 'outlet') }}">Outlet</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div id="content-wrapper" class="left-column col-12 col-md-9 col-lg-10">
        <section id="main">
            <div class="block-category hidden-sm-down">
                <h1 class="h1">{{ $category->name }}</h1>
                @if($category->description)
                <div class="block-category-inner">
                    <div id="category-description" class="text-muted">{{ $category->description }}</div>
                </div>
                @endif
            </div>

            <section id="products">
                <div id="">
                    <div id="js-product-list">
                        <div class="products row products-grid">
                            
                            @forelse($products as $product)
                            <div class="js-product-miniature-wrapper col-6 col-md-6 col-lg-4 col-xl-4">
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
                                        
                                        <!-- Botones funcionales adaptados a Laravel -->
                                        <div class="product-functional-buttons product-functional-buttons-bottom">
                                            <div class="product-functional-buttons-links">
                                                {{-- Wishlist --}}
                                                <a href="#" class="js-iqitwishlist-add" data-id-product="{{ $product->id }}" title="Añadir a mi lista de deseos">
                                                    <i class="fa fa-heart-o not-added"></i>
                                                    <i class="fa fa-heart added" style="display:none; color:#e62228;"></i>
                                                </a>

                                                {{-- Comparar --}}
                                                <a href="#" class="js-iqitcompare-add" data-id-product="{{ $product->id }}" title="Comparar">
                                                    <i class="fa fa-random"></i>
                                                </a>

                                                {{-- Vista Rápida --}}
                                                <a href="#" class="js-quick-view-iqit" data-id-product="{{ $product->id }}" title="Vista rápida">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <div class="product-category-name text-muted">{{ $category->name }}</div>    
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
                            @empty
                            <div class="col-12">
                                <div class="alert alert-warning">No se encontraron productos en esta categoría.</div>
                            </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
</div>
@endsection