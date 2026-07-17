@extends('layouts.tienda')

@section('content')
<style class="elementor-frontend-stylesheet">.elementor-element.elementor-element-5haxn5l{margin-top:0px;margin-bottom:0px;}.elementor-element.elementor-element-rx5s8do > .elementor-element-populated{margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;}.elementor-element.elementor-element-5jgmn6t{margin-top:0px;margin-bottom:15px;padding:0px 0px 5px 0px;}.elementor-element.elementor-element-bakby4y{text-align:left;}.elementor-element.elementor-element-bakby4y .elementor-heading-title{font-size:20px;font-family:'Montserrat', sans-serif, Sans-serif;font-weight:400;text-transform:uppercase;font-style:normal;line-height:0.1em;}.elementor-element.elementor-element-hr1gdxe .swiper-arrows-above .swiper-button{top:-9px;}.elementor-element.elementor-element-hr1gdxe .elementor-swiper-button{color:#ffffff;background:#1c1c1c;}.elementor-element.elementor-element-hr1gdxe .product-miniature, .elementor-element.elementor-element-hr1gdxe .product-miniature a:link:not(.nav-link):not(.btn), .elementor-element.elementor-element-hr1gdxe .product-miniature a:visited:not(.nav-link):not(.btn){color:#000000;}.elementor-element.elementor-element-hr1gdxe .product-miniature .product-price{color:#dd3333;}.elementor-element.elementor-element-hr1gdxe .product-miniature{border-style:solid;border-width:0px 1px 0px 0px;border-color:#c1c1c1;}.elementor-element.elementor-element-1q5gxv2{margin-top:0px;margin-bottom:15px;padding:0px 0px 5px 0px;}.elementor-element.elementor-element-s7kzzf0{text-align:left;}.elementor-element.elementor-element-s7kzzf0 .elementor-heading-title{font-size:20px;font-family:'Montserrat', sans-serif, Sans-serif;font-weight:400;text-transform:uppercase;font-style:normal;line-height:0.1em;}.elementor-element.elementor-element-4jf0kjf .swiper-arrows-above .swiper-button{top:-9px;}.elementor-element.elementor-element-4jf0kjf .elementor-swiper-button{color:#ffffff;background:#1c1c1c;}.elementor-element.elementor-element-4jf0kjf .product-miniature, .elementor-element.elementor-element-4jf0kjf .product-miniature a:link:not(.nav-link):not(.btn), .elementor-element.elementor-element-4jf0kjf .product-miniature a:visited:not(.nav-link):not(.btn){color:#000000;}.elementor-element.elementor-element-4jf0kjf .product-miniature .product-price{color:#dd3333;}.elementor-element.elementor-element-4jf0kjf .product-miniature{border-style:solid;border-width:0px 1px 0px 0px;border-color:#c1c1c1;}.elementor-element.elementor-element-7a5q1sm > .elementor-container{min-height:400px;}.elementor-element.elementor-element-33fd6zf{text-align:left;}.elementor-element.elementor-element-33fd6zf .elementor-heading-title{font-size:16px;text-transform:uppercase;line-height:0.1em;}.elementor-element.elementor-element-wgj3g1l .swiper-arrows-above .swiper-button{top:-9px;}.elementor-element.elementor-element-wgj3g1l .elementor-swiper-button{color:#ffffff;background:#1c1c1c;}.elementor-element.elementor-element-wgj3g1l .product-miniature{border-style:solid;border-width:0px 1px 0px 0px;border-color:#c6c6c6;}.elementor-element.elementor-element-1vhm8cj > .elementor-element-populated{background-image:url("/tienda_assets/img/cms/background_newsletter.jpg");background-position:center center;background-repeat:no-repeat;background-size:cover;}.elementor-element.elementor-element-f2zapkz .elementor-spacer-inner{height:21px;}.elementor-element.elementor-element-k9k0cfi{color:#ffffff;font-size:86px;font-weight:100;text-transform:uppercase;line-height:1em;}.elementor-element.elementor-element-k9k0cfi .elementor-widget-container{padding:10px 0px 10px 0px;}.elementor-element.elementor-element-2zv55qs{color:#ffffff;font-size:14px;font-weight:100;line-height:1.7em;letter-spacing:0.4px;}.elementor-element.elementor-element-2zv55qs .elementor-widget-container{padding:10px 0px 10px 10px;}.elementor-element.elementor-element-i4sy69a .elementor-newsletter-form{max-width:629px;}.elementor-element.elementor-element-i4sy69a .elementor-newsletter-input{min-height:39px;}.elementor-element.elementor-element-i4sy69a .elementor-newsletter-btn{min-height:39px;background:#e62228;}.elementor-element.elementor-element-i4sy69a{text-align:left;}.elementor-element.elementor-element-i4sy69a .elementor-widget-container{padding:020px 0px 20px 10px;}.elementor-element.elementor-element-hjongcn .elementor-iqit-banner-content{text-align:left;padding:0% 30% 0% 5%;}.elementor-element.elementor-element-hjongcn .elementor-iqit-banner .elementor-iqit-banner-title{color:#ffffff;font-size:24px;}.elementor-element.elementor-element-hjongcn .elementor-iqit-banner .elementor-iqit-banner-description{display:block;color:#ffffff;font-size:13px;}.elementor-element.elementor-element-80njb05 .elementor-iqit-banner-content{text-align:left;padding:0% 40% 0% 05%;}.elementor-element.elementor-element-80njb05 .elementor-iqit-banner .elementor-iqit-banner-title{color:#ffffff;font-size:24px;text-transform:uppercase;}.elementor-element.elementor-element-80njb05 .elementor-iqit-banner .elementor-iqit-banner-description{display:block;color:#ffffff;font-size:13px;}.elementor-element.elementor-element-nt8w6dl .elementor-iqit-banner-content{text-align:left;padding:0% 40% 0% 5%;}.elementor-element.elementor-element-nt8w6dl .elementor-iqit-banner .elementor-iqit-banner-title{color:#ffffff;font-size:24px;text-transform:uppercase;}.elementor-element.elementor-element-nt8w6dl .elementor-iqit-banner .elementor-iqit-banner-description{display:block;color:#ffffff;font-size:13px;}@media(max-width: 991px){.elementor-element.elementor-element-f2zapkz .elementor-spacer-inner{height:50px;}.elementor-element.elementor-element-hjongcn .elementor-iqit-banner-content{text-align:center;}.elementor-element.elementor-element-hjongcn .elementor-iqit-banner .elementor-iqit-banner-description{display:block;}.elementor-element.elementor-element-80njb05 .elementor-iqit-banner-content{text-align:center;}.elementor-element.elementor-element-80njb05 .elementor-iqit-banner .elementor-iqit-banner-description{display:block;}.elementor-element.elementor-element-nt8w6dl .elementor-iqit-banner-content{text-align:center;}.elementor-element.elementor-element-nt8w6dl .elementor-iqit-banner .elementor-iqit-banner-description{display:block;}}@media(max-width: 767px){.elementor-element.elementor-element-7a5q1sm{margin-top:10px;margin-bottom:10px;padding:0px 0px 0px 0px;}.elementor-element.elementor-element-j33croa > .elementor-element-populated{margin:010px 0px 010px 0px;}.elementor-element.elementor-element-f2zapkz .elementor-spacer-inner{height:50px;}.elementor-element.elementor-element-k9k0cfi .elementor-text-editor{text-align:center;}.elementor-element.elementor-element-k9k0cfi{font-size:38px;}.elementor-element.elementor-element-2zv55qs .elementor-text-editor{text-align:center;}.elementor-element.elementor-element-2zv55qs{font-size:14px;}.elementor-element.elementor-element-hjongcn .elementor-iqit-banner-content{text-align:center;}.elementor-element.elementor-element-hjongcn .elementor-iqit-banner .elementor-iqit-banner-description{display:block;}.elementor-element.elementor-element-80njb05 .elementor-iqit-banner-content{text-align:center;}.elementor-element.elementor-element-80njb05 .elementor-iqit-banner .elementor-iqit-banner-description{display:block;}.elementor-element.elementor-element-nt8w6dl .elementor-iqit-banner-content{text-align:left;}.elementor-element.elementor-element-nt8w6dl .elementor-iqit-banner .elementor-iqit-banner-description{display:block;} .elementor-heading-title { font-size: 16px !important; margin-bottom: 0 !important; } .swiper-arrows-above .swiper-button { top: -38px !important; width: 28px !important; height: 28px !important; background-color: #666 !important; opacity: 1 !important; border-radius: 0 !important; } .swiper-arrows-above .swiper-button-prev { right: 35px !important; left: auto !important; } .swiper-arrows-above .swiper-button-next { right: 5px !important; left: auto !important; } .swiper-arrows-above .swiper-button::after { font-size: 12px !important; color: #fff !important; } .product-miniature { border-right: 1px solid #eee; padding-bottom: 15px; } .swiper-container-wrapper { padding-top: 5px; } }</style>
				<div class="elementor">
											                        <div class="elementor-section elementor-element elementor-element-5haxn5l elementor-top-section elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-element_type="section">
                            
                           

                            <div class="elementor-container  elementor-column-gap-default      "
                                                                >
                                <div class="elementor-row  ">
                                                                
                            		<div class="elementor-column elementor-element elementor-element-rx5s8do elementor-col-100 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-5vgiszv elementor-widget-image-carousel" data-element_type="image-carousel">
                <div class="elementor-widget-container">
            		<div class="elementor-image-carousel-wrapper"  >
			<div class="elementor-image-carousel swiper-arrows-inside swiper-image-stretch swiper-container  swiper-cls-fix desktop-swiper-cls-fix-1 tablet-swiper-cls-fix-1 mobile-swiper-cls-fix-1" data-slider_options='{"slidesToShow":1,"slidesToShowTablet":1,"slidesToShowMobile":1,"autoplaySpeed":5000,"autoplay":true,"loop":true,"disableOnInteraction":true,"speed":500,"lazy":true,"arrows":true,"dots":true,"fade":false}'>
                
<div class="swiper-wrapper">
    @foreach($banners as $banner)
    <div class="swiper-slide">
        <div class="swiper-slide-inner">
            <a href="{{ $banner->link ?? '#' }}">
                @php
                    $bannerImageUrl = Str::startsWith($banner->image_url, ['http://', 'https://', '/storage/'])
                        ? $banner->image_url
                        : Storage::url($banner->image_url);
                @endphp
                <img class="swiper-slide-image" src="{{ $bannerImageUrl }}" alt="{{ $banner->title }}" style="width: 100%; height: auto;" />
            </a>
        </div>
    </div>
    @endforeach
</div>

                                    <div class="swiper-pagination elementor-swiper-pagination swiper-dots-outside"></div>
                                                    <div class="swiper-button-prev swiper-button elementor-swiper-button elementor-swiper-button-prev"></div>
                    <div class="swiper-button-next swiper-button elementor-swiper-button elementor-swiper-button-next"></div>
                			</div>
		</div>
	        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            </div>
                                
                                                            </div>
                        </div>
                											                        <div class="elementor-section elementor-element elementor-element-5jgmn6t elementor-top-section elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section-content-top" data-element_type="section">
                            
                           

                            <div class="elementor-container  elementor-column-gap-default      "
                                                                >
                                <div class="elementor-row  ">
                                                                
                            		<div class="elementor-column elementor-element elementor-element-ausdwl0 elementor-col-100 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-bakby4y elementor-widget-heading" data-element_type="heading">
                <div class="elementor-widget-container">
            <h2 class="elementor-heading-title elementor-size-default page-title"><span>PRODUCTOS DESTACADOS</span></h2>        </div>
                </div>
                <div class="elementor-widget elementor-element elementor-element-hr1gdxe elementor-widget-prestashop-widget-ProductsList" data-element_type="prestashop-widget-ProductsList">
                <div class="elementor-widget-container">
            <div class="elementor-products">

                    <div class="swiper-container-wrapper swiper-overflow swiper-arrows-above">
            <div class="products elementor-products-carousel swiper-products-carousel swiper-container products-grid  swiper-cls-fix desktop-swiper-cls-fix-6 swiper-cls-row-fix-1 tablet-swiper-cls-fix-6 mobile-swiper-cls-fix-2"  data-slider_options='{"slidesToShow":6,"slidesToShowTablet":6,"slidesToShowMobile":2,"itemsPerColumn":1,"autoplay":true,"arrows":true,"dots":false}'>
                
                <div class="swiper-wrapper">
                    @foreach($featuredProducts as $product)
<div class="swiper-slide"> 
    <div class="js-product-miniature-wrapper product-carousel ">
        <article class="product-miniature product-miniature-default product-miniature-grid product-miniature-layout-1 js-product-miniature" data-id-product="{{ $product->id }}">
            <div class="thumbnail-container">
                <a href="{{ route("tienda.product", $product->id) }}" class="thumbnail product-thumbnail">
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
            <div class="product-description text-center pt-3 pb-3">
                <h3 class="h3 product-title" style="font-size: 14px; font-weight: normal; min-height: 40px;">
                    <a href="{{ route("tienda.product", $product->id) }}" style="color: #333;">{{ $product->name }}</a>
                </h3>
                <div class="product-price-and-shipping mt-2">
                    <a href="{{ route("tienda.product", $product->id) }}"> <span class="price product-price" style="color: #dd3333; font-size: 16px;">${{ number_format($product->price, 2) }}</span></a>
                </div>
            </div>
        </article>
    </div>
</div>

@endforeach
                </div>

                                        </div>
                                        </div>
                                    <div class="swiper-button-prev swiper-button elementor-swiper-button elementor-swiper-button-prev"></div>
                    <div class="swiper-button-next swiper-button elementor-swiper-button elementor-swiper-button-next"></div>
                                            </div>

</div>
        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            </div>
                                
                                                            </div>
                        </div>
                											                        <div class="elementor-section elementor-element elementor-element-1q5gxv2 elementor-top-section elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default elementor-section-content-top" data-element_type="section">
                            
                           

                            <div class="elementor-container  elementor-column-gap-default      "
                                                                >
                                <div class="elementor-row  ">
                                                                
                            		<div class="elementor-column elementor-element elementor-element-mgkfd3n elementor-col-100 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-s7kzzf0 elementor-widget-heading" data-element_type="heading">
                <div class="elementor-widget-container">
            <h2 class="elementor-heading-title elementor-size-default page-title"><span>LINEA BLANCA</span></h2>        </div>
                </div>
                <div class="elementor-widget elementor-element elementor-element-4jf0kjf elementor-widget-prestashop-widget-ProductsList" data-element_type="prestashop-widget-ProductsList">
                <div class="elementor-widget-container">
            <div class="elementor-products">

                    <div class="swiper-container-wrapper swiper-overflow swiper-arrows-above">
            <div class="products elementor-products-carousel swiper-products-carousel swiper-container products-grid  swiper-cls-fix desktop-swiper-cls-fix-6 swiper-cls-row-fix-1 tablet-swiper-cls-fix-6 mobile-swiper-cls-fix-2"  data-slider_options='{"slidesToShow":6,"slidesToShowTablet":6,"slidesToShowMobile":2,"itemsPerColumn":1,"autoplay":false,"arrows":true,"dots":false}'>
                <div class="swiper-wrapper">
                    @foreach($lineaBlancaProducts as $product)
<div class="swiper-slide"> 
    <div class="js-product-miniature-wrapper product-carousel ">
        <article class="product-miniature product-miniature-default product-miniature-grid product-miniature-layout-1 js-product-miniature" data-id-product="{{ $product->id }}">
            <div class="thumbnail-container">
                <a href="{{ route("tienda.product", $product->id) }}" class="thumbnail product-thumbnail">
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
            <div class="product-description text-center pt-3 pb-3">
                <h3 class="h3 product-title" style="font-size: 14px; font-weight: normal; min-height: 40px;">
                    <a href="{{ route("tienda.product", $product->id) }}" style="color: #333;">{{ $product->name }}</a>
                </h3>
                <div class="product-price-and-shipping mt-2">
                    <a href="{{ route("tienda.product", $product->id) }}"> <span class="price product-price" style="color: #dd3333; font-size: 16px;">${{ number_format($product->price, 2) }}</span></a>
                </div>
            </div>
        </article>
    </div>
</div>

@endforeach
                </div>

                                                        </div>
                                        </div>
                                    <div class="swiper-button-prev swiper-button elementor-swiper-button elementor-swiper-button-prev"></div>
                    <div class="swiper-button-next swiper-button elementor-swiper-button elementor-swiper-button-next"></div>
                                            </div>

</div>
        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            </div>
                                
                                                            </div>
                        </div>
                											                        <div class="elementor-section elementor-element elementor-element-7a5q1sm elementor-top-section elementor-section-boxed elementor-section-height-min-height elementor-section-height-default elementor-section-items-top" data-element_type="section">
                            
                           

                            <div class="elementor-container  elementor-column-gap-default      "
                                                                >
                                <div class="elementor-row  ">
                                                                
                            		<div class="elementor-column elementor-element elementor-element-j33croa elementor-col-100 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-33fd6zf elementor-widget-heading" data-element_type="heading">
                <div class="elementor-widget-container">
            <h2 class="elementor-heading-title elementor-size-large page-title"><span>REFACCIONES</span></h2>        </div>
                </div>
                <div class="elementor-widget elementor-element elementor-element-wgj3g1l elementor-widget-prestashop-widget-ProductsList" data-element_type="prestashop-widget-ProductsList">
                <div class="elementor-widget-container">
            <div class="elementor-products">

                    <div class="swiper-container-wrapper swiper-overflow swiper-arrows-above">
            <div class="products elementor-products-carousel swiper-products-carousel swiper-container products-grid  swiper-cls-fix desktop-swiper-cls-fix-6 swiper-cls-row-fix-1 tablet-swiper-cls-fix-6 mobile-swiper-cls-fix-2"  data-slider_options='{"slidesToShow":6,"slidesToShowTablet":6,"slidesToShowMobile":2,"itemsPerColumn":1,"autoplay":true,"arrows":true,"dots":false}'>
                <div class="swiper-wrapper">
                    @foreach($refaccionesProducts as $product)
<div class="swiper-slide"> 
    <div class="js-product-miniature-wrapper product-carousel ">
        <article class="product-miniature product-miniature-default product-miniature-grid product-miniature-layout-1 js-product-miniature" data-id-product="{{ $product->id }}">
            <div class="thumbnail-container">
                <a href="{{ route("tienda.product", $product->id) }}" class="thumbnail product-thumbnail">
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
            <div class="product-description text-center pt-3 pb-3">
                <h3 class="h3 product-title" style="font-size: 14px; font-weight: normal; min-height: 40px;">
                    <a href="{{ route("tienda.product", $product->id) }}" style="color: #333;">{{ $product->name }}</a>
                </h3>
                <div class="product-price-and-shipping mt-2">
                    <a href="{{ route("tienda.product", $product->id) }}"> <span class="price product-price" style="color: #dd3333; font-size: 16px;">${{ number_format($product->price, 2) }}</span></a>
                </div>
            </div>
        </article>
    </div>
</div>

@endforeach
                </div>

                                                        </div>
                                        </div>
                                    <div class="swiper-button-prev swiper-button elementor-swiper-button elementor-swiper-button-prev"></div>
                    <div class="swiper-button-next swiper-button elementor-swiper-button elementor-swiper-button-next"></div>
                                            </div>

</div>
        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            </div>
                                
                                                            </div>
                        </div>
                											                        <div class="elementor-section elementor-element elementor-element-n00lb1h elementor-top-section elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-element_type="section">
                            
                           

                            <div class="elementor-container  elementor-column-gap-default      "
                                                                >
                                <div class="elementor-row  ">
                                                                
                            		<div class="elementor-column elementor-element elementor-element-1vhm8cj elementor-col-100 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-f2zapkz elementor-widget-spacer" data-element_type="spacer">
                <div class="elementor-widget-container">
            		<div class="elementor-spacer">
			<div class="elementor-spacer-inner"></div>
		</div>
		        </div>
                </div>
                <div class="elementor-widget elementor-element elementor-element-k9k0cfi elementor-widget-text-editor" data-element_type="text-editor">
                <div class="elementor-widget-container">
            		<div class="elementor-text-editor rte-content"><p><span style="color: #ffffff;">Newsletter</span></p></div>
		        </div>
                </div>
                <div class="elementor-widget elementor-element elementor-element-2zv55qs elementor-widget-text-editor" data-element_type="text-editor">
                <div class="elementor-widget-container">
            		<div class="elementor-text-editor rte-content"><p><span style="color: #ffffff;">Entérate de nuestras promociones y sé parte de la comunidad Mirage.<br /></span></p></div>
		        </div>
                </div>
                <div class="elementor-widget elementor-element elementor-element-i4sy69a elementor-widget-prestashop-widget-Newsletter" data-element_type="prestashop-widget-Newsletter">
                <div class="elementor-widget-container">
            
<div class="elementor-newsletter newsletter-form">
    <form action="//www.tiendamirage.mx/?fc=module&module=iqitemailsubscriptionconf&controller=subscription" method="post" class="elementor-newsletter-form">
        <div class="row">
            <div class="col-12">
                <input
                        class="btn btn-primary pull-right hidden-xs-down elementor-newsletter-btn"
                        name="submitNewsletter"
                        type="submit"
                        value="Suscribirse"
                >
                <input
                        class="btn btn-primary pull-right hidden-sm-up elementor-newsletter-btn"
                        name="submitNewsletter"
                        type="submit"
                        value="OK"
                >
                <div class="input-wrapper">
                    <input
                            name="email"
                            class="form-control elementor-newsletter-input"
                            type="email"
                            value=""
                            placeholder="Su correo electrónico"
                    >
                </div>
                <input type="hidden" name="action" value="0">
                
                                    <div class="mt-2 text-muted"> </div>
                            </div>
        </div>
    </form>
</div>        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            </div>
                                
                                                            </div>
                        </div>
                											                        <div class="elementor-section elementor-element elementor-element-okdt17h elementor-top-section elementor-section-stretched elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-element_type="section">
                            
                           

                            <div class="elementor-container  elementor-column-gap-default      "
                                                                >
                                <div class="elementor-row  ">
                                                                
                            		<div class="elementor-column elementor-element elementor-element-6hy3wid elementor-col-33 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-hjongcn elementor-widget-banner" data-element_type="banner">
                <div class="elementor-widget-container">
            <div class="elementor-iqit-banner"><figure class="elementor-iqit-banner-img"><span class="elementor-iqit-banner-overlay"></span><img  loading="lazy"    src="/tienda_assets/img/cms/banner_satisfaccion.jpg" alt=""></figure><div class="elementor-iqit-banner-content elementor-iqit-banner-content-on elementor-banner-align-middle-left"><h4 class="elementor-iqit-banner-title">SATISFACCIÓN GARANTIZADA</h4><div class="elementor-iqit-banner-description">Cumplimos con las mas exigentes normas de producción, garantizamos tu descanso.</div></div></div>        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            
                            		<div class="elementor-column elementor-element elementor-element-retdm89 elementor-col-33 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-80njb05 elementor-widget-banner" data-element_type="banner">
                <div class="elementor-widget-container">
            <div class="elementor-iqit-banner"><figure class="elementor-iqit-banner-img"><span class="elementor-iqit-banner-overlay"></span><img  loading="lazy"    src="/tienda_assets/img/cms/banner_pagoseguros.jpg" alt=""></figure><div class="elementor-iqit-banner-content elementor-iqit-banner-content-on elementor-banner-align-middle-left"><h4 class="elementor-iqit-banner-title">Pagos Seguros</h4><div class="elementor-iqit-banner-description">Todos tus pagos son seguros y tenemos diferentes metodos de pago para ti.</div></div></div>        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            
                            		<div class="elementor-column elementor-element elementor-element-wl5qvi1 elementor-col-33 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap elementor-element-populated">
				<div class="elementor-widget-wrap">
		        <div class="elementor-widget elementor-element elementor-element-nt8w6dl elementor-widget-banner" data-element_type="banner">
                <div class="elementor-widget-container">
            <div class="elementor-iqit-banner"><figure class="elementor-iqit-banner-img"><span class="elementor-iqit-banner-overlay"></span><img  loading="lazy"    src="/tienda_assets/img/cms/banner_envios.jpg" alt=""></figure><div class="elementor-iqit-banner-content elementor-iqit-banner-content-on elementor-banner-align-middle-left"><h4 class="elementor-iqit-banner-title">Envíos a todo el país</h4><div class="elementor-iqit-banner-description">Cumplimos con las mas exigentes normas de producción, garantizamos tu descanso</div></div></div>        </div>
                </div>
        				</div>
			</div>
		</div>
		                             
                                                            </div>
                                
                                                            </div>
                        </div>
                											                        <div class="elementor-section elementor-element elementor-element-m2mpdry elementor-top-section elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-element_type="section">
                            
                           

                            <div class="elementor-container  elementor-column-gap-default      "
                                                                >
                                <div class="elementor-row  ">
                                                                
                            		<div class="elementor-column elementor-element elementor-element-ygfvz5y elementor-col-100 elementor-top-column" data-element_type="column">
			<div class="elementor-column-wrap">
				<div class="elementor-widget-wrap">
						</div>
			</div>
		</div>
		                             
                                                            </div>
                                
                                                            </div>
                        </div>
                							</div>
		



            
        
    </section>


    
      <footer class="page-footer">
        
          <!-- Footer content -->
        
      </footer>
    

  
@endsection
