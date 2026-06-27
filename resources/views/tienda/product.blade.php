<!doctype html>
<html lang="mx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ $product->name }} | Mirage</title>
  
  <meta name="description" content="{{ Str::limit(strip_tags($product->description), 150) }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="icon" type="image/vnd.microsoft.icon" href="/tienda_assets/img/favicon.ico?1542144254">
  <link rel="shortcut icon" type="image/x-icon" href="/tienda_assets/img/favicon.ico?1542144254">
    
  <link rel="stylesheet" href="/tienda_assets/themes/warehouse/assets/css/theme.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/revsliderprestashop/public/assets/css/rs6.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitcountdown/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/contentbox/content//Mirageinter.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/facebookpsconnect/views/css/hook.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/facebookpsconnect/views/css/bootstrap-social.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/facebookpsconnect/views/css/font-awesome.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/facebookpsconnect/views/css/jquery.fancybox-1.3.4.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/facebookpsconnect/views/css/connectors.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/winningorders/views/css/winningorders.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/winningorders//views/css/plugins/countdown.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/mercadopago/views/css/front.min.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/mercadopago/views/css/pixFront.min.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/mercadopago/views/css/pse.min.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/js/jquery/plugins/fancybox/jquery.fancybox.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitcompare/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitelementor/views/css/frontend.min.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitmegamenu/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitreviews/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitsizecharts/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitthemeeditor/views/css/custom_s_1.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitwishlist/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitextendedproduct/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/themes/warehouse/modules/ph_simpleblog/views/css/ph_simpleblog-17.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/ph_simpleblog/css/custom.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitsociallogin/views/css/front.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/modules/iqitmegamenu/views/css/iqitmegamenu_s_1.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/themes/warehouse/assets/css/font-awesome/css/font-awesome.css" type="text/css" media="all">
  <link rel="stylesheet" href="/tienda_assets/themes/warehouse/assets/css/custom.css" type="text/css" media="all">

  <script>
    var elementorFrontendConfig = {"isEditMode":"","stretchedSectionContainer":"","instagramToken":"","is_rtl":false,"ajax_csfr_token_url":""};
    var iqitTheme = {"rm_sticky":"0","rm_breakpoint":0,"op_preloader":"0","cart_style":"floating","cart_confirmation":"open","h_layout":"2","f_fixed":"","f_layout":"2","h_absolute":"0","h_sticky":"header","hw_width":"inherit","mm_content":"accordion","hm_submenu_width":"default","h_search_type":"full","pl_lazyload":true};
    var iqitcompare = {"nbProducts":0};
    var iqitwishlist = {"nbProducts":0};
    var prestashop = {"cart":{"products":[],"totals":{"total":{"amount":0,"value":"$0.00"}},"products_count":0}};
  </script>
</head>

<body id="product" class="lang-mx country-mx currency-mxn layout-full-width page-product tax-display-enabled body-desktop-header-style-w-2 customer-not-logged">

<main id="main-page-content">
  <header id="header" class="desktop-header-style-w-2">
    <nav class="header-nav" style="padding: 8px 0;">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col col-auto col-md left-nav"></div>
          <div class="col col-auto col-md right-nav text-right">
            <div class="d-inline-block">
              <a href="{{ route('wishlist.index') }}" style="color: #cbd5e0; font-size: 13px; text-decoration: none;">
                <i class="fa fa-heart-o fa-fw" aria-hidden="true"></i> Lista de deseos (<span id="iqitwishlist-nb">0</span>)
              </a>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div id="desktop-header" class="desktop-header-style-2">
      <div class="header-top">
        <div id="desktop-header-container" class="container">
          <div class="row align-items-center">
            <div class="col col-auto col-header-left">
              <div id="desktop_logo">
                <a href="{{ route('tienda.index') }}">
                  <img class="logo img-fluid" src="{{ $businessSetting->logo_path ?? '/tienda/img/mirage-logo-1534899548.jpg' }}" alt="{{ $businessSetting->name ?? 'Mirage' }}" width="307" height="43">
                </a>
              </div>
            </div>
            <div class="col col-header-center">
              <div id="search_widget" class="search-widget">
                <form method="get" action="{{ route('tienda.index') }}">
                  <div class="input-group">
                    <input type="text" name="s" placeholder="Buscar" class="form-control form-search-control" autocomplete="off" />
                    <button type="submit" class="search-btn">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="col col-header-right">
              <div class="row no-gutters justify-content-end">
                <div id="header-user-btn" class="col col-auto header-btn-w header-user-btn-w">
                  <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="header-btn header-user-btn">
                    <i class="fa fa-user fa-fw icon" aria-hidden="true"></i>
                    <span class="title">Iniciar sesión</span>
                  </a>
                </div>
                <div id="ps-shoppingcart-wrapper" class="col col-auto">
                  <div id="ps-shoppingcart" class="header-btn-w header-cart-btn-w ps-shoppingcart dropdown">
                    <a id="cart-toogle" href="{{ route('cart.index') }}" class="cart-toogle header-btn header-cart-btn">
                      <i class="fa fa-shopping-bag fa-fw icon" aria-hidden="true"></i>
                      <span class="info-wrapper">
                        <span class="title">Carrito:</span>
                        <span class="cart-toggle-details" style="display: block; font-size: 13px; font-weight: normal; margin-top: -2px;">{{ $cartCount > 0 ? $cartCount . ' articulos' : 'Vacío' }}</span>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Megamenu Menu -->
    <div class="container iqit-megamenu-container">
      <div id="iqitmegamenu-wrapper" class="iqitmegamenu-wrapper iqitmegamenu-all">
        <div class="container container-iqitmegamenu">
          <div id="iqitmegamenu-horizontal" class="iqitmegamenu clearfix" role="navigation">
            <nav id="cbp-hrmenu" class="cbp-hrmenu cbp-horizontal cbp-hrsub-narrow">
              <ul>
                @foreach($categories as $cat)
                  @if($cat->children->count() > 0)
                    <li class="cbp-hrmenu-tab cbp-hrmenu-tab-has-sub">
                      <a href="{{ route('tienda.category', $cat->slug) }}" class="nav-link">
                        <span class="cbp-tab-title">{{ mb_strtoupper($cat->name) }}</span>
                      </a>
                      <div class="cbp-hrsub cbp-hrsub-narrow">
                        <div class="cbp-hrsub-inner">
                          <ul>
                            @foreach($cat->children as $child)
                              <li>
                                <a href="{{ route('tienda.category', $child->slug) }}">{{ $child->name }}</a>
                              </li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </li>
                  @else
                    <li class="cbp-hrmenu-tab">
                      <a href="{{ route('tienda.category', $cat->slug) }}" class="nav-link">
                        <span class="cbp-tab-title">{{ mb_strtoupper($cat->name) }}</span>
                      </a>
                    </li>
                  @endif
                @endforeach
                <li class="cbp-hrmenu-tab">
                  <a href="{{ route('tienda.category', 'contactenos') }}" class="nav-link">
                    <span class="cbp-tab-title">CONTACTO</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Container -->
  <div id="wrapper" style="background-color: #f8fafc; padding-top: 60px; padding-bottom: 50px;">
    <div class="container">
      
      <!-- Breadcrumb -->
      <nav class="breadcrumb" style="background: transparent; padding: 0; margin-bottom: 25px; font-size: 14px; font-family: 'Montserrat', sans-serif;">
        <ol style="display: flex; gap: 8px; list-style: none; padding: 0; margin: 0; color: #64748b;">
          <li><a href="{{ route('tienda.index') }}" style="color: #64748b; text-decoration: none;">Inicio</a></li>
          @if($product->category)
            <li><span style="margin: 0 4px;">/</span> <a href="{{ route('tienda.category', $product->category->slug) }}" style="color: #64748b; text-decoration: none;">{{ $product->category->name }}</a></li>
          @endif
          <li><span style="margin: 0 4px;">/</span> <span style="color: #0f172a; font-weight: 500;">{{ $product->name }}</span></li>
        </ol>
      </nav>

      <div id="content-wrapper" class="row" style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); padding: 40px; margin: 0; font-family: 'Montserrat', sans-serif;">
        
        <div class="col-12">
          <div class="row">
            <!-- Left Column: Image Gallery -->
            <div class="col-12 col-md-6">
              <div class="main-image-container" style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; display: flex; align-items: center; justify-content: center; height: 420px; background: #fff; position: relative;">
                @if($product->discount_price)
                  <span style="position: absolute; top: 15px; left: 15px; background: #0066cc; color: white; padding: 4px 10px; border-radius: 4px; font-weight: 600; font-size: 13px; z-index: 2;">-{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</span>
                @endif
                @php
                  $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                  $imageUrl = $primaryImage ? (Str::startsWith($primaryImage->image_url, 'http') ? $primaryImage->image_url : Storage::url($primaryImage->image_url)) : '/tienda/img/mirage-logo-1534899548.jpg';
                @endphp
                <img id="main-product-detail-img" src="{{ $imageUrl }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
              </div>
              <div class="thumbnails-container" style="display: flex; gap: 10px; margin-top: 15px; overflow-x: auto; padding-bottom: 5px;">
                @foreach($product->images as $index => $img)
                  @php
                    $thumbUrl = Str::startsWith($img->image_url, 'http') ? $img->image_url : Storage::url($img->image_url);
                  @endphp
                  <button class="thumb-btn {{ $index === 0 ? 'active' : '' }}" onclick="changeDetailImage('{{ $thumbUrl }}', this)" style="width: 70px; height: 70px; border: 2px solid #e2e8f0; border-radius: 6px; background: #fff; cursor: pointer; padding: 4px; flex-shrink: 0; transition: border-color 0.2s; outline: none;">
                    <img src="{{ $thumbUrl }}" style="width: 100%; height: 100%; object-fit: contain;">
                  </button>
                @endforeach
              </div>
            </div>
            
            <!-- Right Column: Specs & Actions -->
            <div class="col-12 col-md-6">
              <h1 style="font-size: 26px; font-weight: 600; color: #0f172a; margin-top: 0; margin-bottom: 15px; line-height: 1.2;">{{ $product->name }}</h1>
              
              <div class="price-container" style="display: flex; align-items: baseline; flex-wrap: wrap; gap: 10px; margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 15px;">
                @if($product->discount_price)
                  <span id="display-discount-price" style="font-size: 26px; font-weight: 700; color: #ef4444;">${{ number_format($product->discount_price, 2) }}</span>
                  <span id="display-regular-price" style="font-size: 18px; text-decoration: line-through; color: #94a3b8; font-weight: 500;">${{ number_format($product->price, 2) }}</span>
                  @php
                    $discountPct = round((($product->price - $product->discount_price) / $product->price) * 100);
                  @endphp
                  <span id="display-discount-badge" class="discount-badge" style="background: #eff6ff; color: #1d4ed8; font-size: 13px; font-weight: 600; padding: 3px 8px; border-radius: 4px; border: 1px solid #bfdbfe; font-family: sans-serif;">-{{ $discountPct }}%</span>
                @else
                  <span id="display-regular-price" style="font-size: 26px; font-weight: 700; color: #0f172a;">${{ number_format($product->price, 2) }}</span>
                  <span id="display-discount-price" style="font-size: 26px; font-weight: 700; color: #ef4444; display:none;"></span>
                  <span id="display-discount-badge" class="discount-badge" style="display:none; background: #eff6ff; color: #1d4ed8; font-size: 13px; font-weight: 600; padding: 3px 8px; border-radius: 4px; border: 1px solid #bfdbfe; font-family: sans-serif;"></span>
                @endif
                <div style="width: 100%; font-size: 12px; color: #94a3b8; margin-top: 4px; font-weight: 500;">IVA incluido</div>
              </div>
              
              <!-- Variantes del Producto -->
              @if($product->variants && $product->variants->count() > 0)
              <div class="product-variants" style="margin-bottom: 25px;">
                <label for="variant-select" style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Selecciona la capacidad / modelo:</label>
                <select id="variant-select" onchange="updateVariantDetails()" style="width: 100%; max-width: 300px; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; background: #fff; font-size: 15px; outline: none;">
                  <option value="">Selecciona una opción...</option>
                  @foreach($product->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                  @endforeach
                </select>
              </div>
              @endif

              <div class="short-description" style="margin-bottom: 25px;">
                @if($product->short_description)
                  <p style="font-size: 14px; color: #475569; line-height: 1.7; margin-bottom: 12px;">{{ $product->short_description }}</p>
                @endif

                @if($product->specifications)
                  <ul style="list-style: none; padding: 0; margin: 0 0 15px 0; font-size: 13px; color: #475569; line-height: 1.8;">
                    @foreach(array_slice($product->specifications, 0, 5) as $spec)
                      <li style="display: flex; align-items: flex-start; gap: 6px; margin-bottom: 2px;">
                        <i class="fa fa-check" style="color: #10b981; margin-top: 3px; flex-shrink: 0;"></i>
                        {{ $spec }}
                      </li>
                    @endforeach
                    @if(count($product->specifications) > 5)
                      <li style="color: #94a3b8; font-size: 12px; margin-top: 4px;">+ {{ count($product->specifications) - 5 }} características más en la Ficha técnica</li>
                    @endif
                  </ul>
                @endif

                <p style="font-weight: 700; font-size: 13px; color: #0f172a; margin-bottom: 8px;">* No incluye instalación.</p>
                <p style="font-size: 13px; color: #64748b; line-height: 1.6; background: #f8fafc; border-left: 4px solid #ef4444; padding: 12px; border-radius: 0 6px 6px 0; margin-bottom: 0;">
                  Este equipo cuenta con un año de garantía y 6 años en el compresor, solo si se instala a través de un Centro de Servicios Autorizado Mirage (CESAM).
                </p>
              </div>
              
              <!-- Cart add form -->
              <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form" style="display: flex; gap: 15px; margin-bottom: 25px; border-bottom: 1px solid #f1f5f9; padding-bottom: 25px;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" id="selected_variant_id" value="">
                
                <div class="quantity-selector" style="display: flex; align-items: center; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; height: 48px; background: #fff;">
                  <button type="button" onclick="adjustDetailQty(-1)" style="background: #f8fafc; border: none; width: 40px; height: 100%; cursor: pointer; font-size: 16px; font-weight: 600; color: #64748b; transition: background-color 0.2s;">-</button>
                  <input type="number" name="quantity" id="detail-qty-input" value="1" min="1" max="{{ $product->stock }}" style="width: 50px; height: 100%; border: none; border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; text-align: center; font-size: 15px; font-weight: 600; color: #0f172a; outline: none; margin: 0; padding: 0;">
                  <button type="button" onclick="adjustDetailQty(1)" style="background: #f8fafc; border: none; width: 40px; height: 100%; cursor: pointer; font-size: 16px; font-weight: 600; color: #64748b; transition: background-color 0.2s;">+</button>
                </div>
                
                <button type="submit" style="flex-grow: 1; background: #ef4444; color: #ffffff; border: none; border-radius: 6px; height: 48px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: background-color 0.2s; outline: none;">
                  <i class="fa fa-shopping-bag"></i> Añadir al carrito
                </button>
              </form>
              
              <div class="secondary-actions" style="display: flex; gap: 15px;">
                <button type="button" class="js-iqitwishlist-add" data-id-product="{{ $product->id }}" style="flex: 1; background: #94a3b8; color: #ffffff; border: none; border-radius: 6px; padding: 12px 10px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background-color 0.2s; outline: none;">
                  <i class="fa fa-heart-o not-added"></i>
                  <i class="fa fa-heart added" style="display:none; color:#ffffff;"></i>
                  <span class="btn-text not-added">Añadir a deseos</span>
                  <span class="btn-text added" style="display:none;">En tu Wishlist</span>
                </button>
                <button type="button" onclick="addToCompare('{{ $product->id }}', this)" class="js-iqitcompare-add" data-id-product="{{ $product->id }}" style="flex: 1; background: #94a3b8; color: #ffffff; border: none; border-radius: 6px; padding: 12px 10px; font-size: 14px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background-color 0.2s; outline: none;">
                  <i class="fa fa-random"></i> <span class="btn-text">Comparar</span>
                </button>
              </div>

              <script>
                function toggleWishlist(productId, btn) {
                    const icon = btn.querySelector('i');
                    const text = btn.querySelector('.btn-text');
                    
                    fetch('{{ route("wishlist.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_id: productId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            btn.style.backgroundColor = '#ef4444'; // Red when active
                            icon.classList.remove('fa-heart-o');
                            icon.classList.add('fa-heart');
                            text.innerText = 'En tu Wishlist';
                        } else if(data.status === 'unauthorized') {
                            window.location.href = '{{ route("login") }}';
                        }
                    })
                    .catch(err => console.error(err));
                }

                function addToCompare(productId, btn) {
                    fetch('{{ route("compare.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ product_id: productId })
                    })
                    .then(res => {
                        if (!res.ok && res.status !== 422) throw new Error('Error network');
                        return res.json();
                    })
                    .then(data => {
                        if (data.status === 'success' || data.status === 'info') {
                            btn.style.backgroundColor = '#3b82f6'; // Blue when added
                            btn.querySelector('.btn-text').innerText = 'Agregado (' + data.count + ')';
                        } else if(data.status === 'error') {
                            alert(data.message); // Too many products
                        }
                    })
                    .catch(err => console.error(err));
                }
              </script>
            </div>
          </div>
          
          <!-- Tab Section -->
          <div class="product-tabs-container" style="margin-top: 50px; border-top: 1px solid #e2e8f0; padding-top: 30px;">
            <ul class="nav nav-tabs" id="product-tabs" style="display: flex; gap: 20px; border-bottom: 2px solid #e2e8f0; margin-bottom: 25px; padding-bottom: 10px; list-style: none; padding-left: 0;">
              <li class="active"><a href="#tab-description" class="mrg-tab active-tab" onclick="switchTab(event, 'tab-description')" style="font-weight: 600; text-decoration: none; color: #ef4444; border-bottom: 2px solid #ef4444; padding-bottom: 10px; font-size: 15px;">Descripción</a></li>
              <li><a href="#tab-details" class="mrg-tab" onclick="switchTab(event, 'tab-details')" style="font-weight: 600; text-decoration: none; color: #64748b; padding-bottom: 10px; font-size: 15px;">Detalles del producto</a></li>
              <li><a href="#tab-sheet" class="mrg-tab" onclick="switchTab(event, 'tab-sheet')" style="font-weight: 600; text-decoration: none; color: #64748b; padding-bottom: 10px; font-size: 15px;">Ficha técnica</a></li>
              <li><a href="#tab-reviews" class="mrg-tab" onclick="switchTab(event, 'tab-reviews')" style="font-weight: 600; text-decoration: none; color: #64748b; padding-bottom: 10px; font-size: 15px;">Opiniones({{ $reviews->count() }})</a></li>
            </ul>
            
            <div class="mrg-content" id="product-tabs-content" style="font-size: 14px; color: #475569; line-height: 1.7;">
              <!-- Descripción Pane -->
              <div id="tab-description" class="mrg-panel" style="display: block;">
                @if($product->long_description)
                  <div style="max-width: 800px;">
                    <h4 style="font-weight: 600; color: #0f172a; font-size: 16px; margin-bottom: 16px;">{{ $product->name }}</h4>
                    <p style="color: #475569; line-height: 1.8; font-size: 14px;">{{ $product->long_description }}</p>
                  </div>
                @elseif($product->short_description)
                  <p style="color: #475569; line-height: 1.8; font-size: 14px;">{{ $product->short_description }}</p>
                @else
                  <p style="color: #94a3b8; font-size: 14px;">No hay descripción disponible para este producto.</p>
                @endif
              </div>
              
              <!-- Detalles Pane -->
              <div id="tab-details" class="mrg-panel" style="display: none;">
                <table style="width: 100%; max-width: 480px; border-collapse: collapse; font-size: 14px;">
                  <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Marca</td>
                    <td style="padding: 12px 0; text-align: right; color: #0f172a;">Mirage</td>
                  </tr>
                  <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">SKU / Referencia</td>
                    <td style="padding: 12px 0; text-align: right;">
                      <code id="display-sku" style="background: #f1f5f9; color: #334155; padding: 2px 8px; border-radius: 4px; font-size: 13px;">{{ $product->sku ?: 'N/A' }}</code>
                    </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Categoría</td>
                    <td style="padding: 12px 0; text-align: right; color: #0f172a;">
                      @if($product->category)
                        <a href="{{ route('tienda.category', $product->category->slug) }}" style="color: #ef4444; text-decoration: none;">{{ $product->category->name }}</a>
                      @else
                        General
                      @endif
                    </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Disponibilidad</td>
                    <td style="padding: 12px 0; text-align: right;">
                      @if($product->stock > 10)
                        <span style="color: #10b981; font-weight: 600;">✓ En stock ({{ $product->stock }} disponibles)</span>
                      @elseif($product->stock > 0)
                        <span style="color: #f59e0b; font-weight: 600;">⚡ Últimas {{ $product->stock }} unidades</span>
                      @else
                        <span style="color: #ef4444; font-weight: 600;">✗ Agotado</span>
                      @endif
                    </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Precio regular</td>
                    <td style="padding: 12px 0; text-align: right; color: #0f172a;">
                      @if($product->discount_price)
                        <span style="text-decoration: line-through; color: #94a3b8;">${{ number_format($product->price, 2) }}</span>
                      @else
                        ${{ number_format($product->price, 2) }}
                      @endif
                    </td>
                  </tr>
                  @if($product->discount_price)
                  <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Precio oferta</td>
                    <td style="padding: 12px 0; text-align: right;">
                      <span style="color: #ef4444; font-weight: 700;">${{ number_format($product->discount_price, 2) }}</span>
                      <span style="background: #fef2f2; color: #dc2626; font-size: 12px; padding: 2px 6px; border-radius: 4px; margin-left: 6px;">-{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%</span>
                    </td>
                  </tr>
                  <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Ahorro</td>
                    <td style="padding: 12px 0; text-align: right; color: #10b981; font-weight: 600;">
                      ${{ number_format($product->price - $product->discount_price, 2) }} MXN
                    </td>
                  </tr>
                  @endif
                  <tr>
                    <td style="padding: 12px 0; font-weight: 600; color: #64748b;">Garantía</td>
                    <td style="padding: 12px 0; text-align: right; color: #0f172a;">1 año equipo / 6 años compresor (CESAM)</td>
                  </tr>
                </table>
              </div>
              
              <!-- Ficha Técnica Pane -->
              <div id="tab-sheet" class="mrg-panel" style="display: none;">
                @if($product->specifications && count($product->specifications) > 0)
                  <h4 style="font-weight: 600; color: #0f172a; font-size: 15px; margin-bottom: 20px;">Especificaciones técnicas</h4>
                  <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 30px;">
                    @foreach($product->specifications as $index => $spec)
                      <tr style="border-bottom: 1px solid #e2e8f0; {{ $index % 2 === 0 ? 'background-color: #f8fafc;' : '' }}">
                        <td style="padding: 10px 12px; color: #475569; line-height: 1.5;">
                          <i class="fa fa-check-circle" style="color: #10b981; margin-right: 8px;"></i>{{ $spec }}
                        </td>
                      </tr>
                    @endforeach
                  </table>
                @endif
                
                <h4 style="font-weight: 600; color: #0f172a; font-size: 15px; margin-bottom: 20px;">Descargas y Documentos</h4>
                @if($product->documents && $product->documents->count() > 0)
                  <div style="display: flex; flex-direction: column; gap: 15px;">
                    @foreach($product->documents as $doc)
                      <a href="{{ Storage::url($doc->file_path) }}" target="_blank" style="display: flex; align-items: center; justify-content: space-between; padding: 15px; border: 1px solid #e2e8f0; border-radius: 8px; background: #fff; text-decoration: none; transition: border-color 0.2s;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                          <i class="fa fa-file-pdf-o" style="font-size: 24px; color: #ef4444;"></i>
                          <div>
                            <span style="display: block; font-weight: 600; color: #0f172a; font-size: 15px;">{{ $doc->title }}</span>
                            <span style="color: #64748b; font-size: 13px;">{{ ucfirst(str_replace('_', ' ', $doc->type)) }}</span>
                          </div>
                        </div>
                        <i class="fa fa-download" style="color: #94a3b8; font-size: 18px;"></i>
                      </a>
                    @endforeach
                  </div>
                @else
                  <p style="color: #94a3b8; font-size: 14px;">Para descargar la ficha técnica oficial y manuales de instalación de este equipo Mirage, por favor comuníquese con nosotros o visite tiendamirage.mx</p>
                @endif
              </div>
              
              <!-- Opiniones Pane -->
              <div id="tab-reviews" class="mrg-panel" style="display: none;">
                @if(session('success'))
                  <div style="background-color: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                    <i class="fa fa-check-circle" style="font-size: 18px; color: #10b981;"></i>
                    {{ session('success') }}
                  </div>
                @endif

                @if($reviews->count() > 0)
                  <div class="reviews-list" style="margin-bottom: 40px; display: flex; flex-direction: column; gap: 20px;">
                    @foreach($reviews as $rev)
                      <div class="review-item" style="border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                          <div>
                            <strong style="color: #0f172a; font-size: 15px;">{{ $rev->customer_name }}</strong>
                            <span style="color: #64748b; font-size: 12px; margin-left: 10px;">{{ $rev->created_at->format('d/m/Y H:i') }}</span>
                          </div>
                          <div style="color: #f59e0b; display: flex; gap: 2px;">
                            @for($i = 1; $i <= 5; $i++)
                              <i class="fa {{ $i <= $rev->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                            @endfor
                          </div>
                        </div>
                        <p style="margin: 0; color: #334155; font-size: 14px;">{{ $rev->comment }}</p>
                      </div>
                    @endforeach
                  </div>
                @else
                  <p style="margin-bottom: 30px;">No hay opiniones de clientes por ahora.</p>
                @endif

                <!-- Formulario de Opinión -->
                <div class="review-form-container" style="background: #f8fafc; border-radius: 8px; padding: 30px; border: 1px solid #e2e8f0;">
                  <h4 style="font-size: 16px; font-weight: 600; color: #0f172a; margin-top: 0; margin-bottom: 20px; border-bottom: 2px solid #ef4444; padding-bottom: 8px; display: inline-block;">Dejar una opinión</h4>
                  
                  <form action="{{ route('tienda.product.review', $product->slug) }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 20px;">
                      <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Calificación:</label>
                      <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="hidden" name="rating" id="review-rating-input" value="5">
                        <div class="star-rating-selector" style="display: flex; gap: 5px; font-size: 20px; color: #f59e0b; cursor: pointer;">
                          <i class="fa fa-star star-select" data-value="1" onclick="setSelectRating(1)"></i>
                          <i class="fa fa-star star-select" data-value="2" onclick="setSelectRating(2)"></i>
                          <i class="fa fa-star star-select" data-value="3" onclick="setSelectRating(3)"></i>
                          <i class="fa fa-star star-select" data-value="4" onclick="setSelectRating(4)"></i>
                          <i class="fa fa-star star-select" data-value="5" onclick="setSelectRating(5)"></i>
                        </div>
                      </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                      <div>
                        <label for="customer_name" style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Nombre *</label>
                        <input type="text" name="customer_name" id="customer_name" required value="{{ auth()->check() ? auth()->user()->name : '' }}" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 12px; font-size: 14px; outline: none; background: #fff;">
                      </div>
                      <div>
                        <label for="customer_email" style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Correo electrónico</label>
                        <input type="email" name="customer_email" id="customer_email" value="{{ auth()->check() ? auth()->user()->email : '' }}" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 12px; font-size: 14px; outline: none; background: #fff;">
                      </div>
                    </div>

                    <div style="margin-bottom: 25px;">
                      <label for="comment" style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Opinión *</label>
                      <textarea name="comment" id="comment" required rows="4" style="width: 100%; border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 12px; font-size: 14px; outline: none; background: #fff; resize: vertical;" placeholder="Escribe tu opinión aquí..."></textarea>
                    </div>

                    <button type="submit" style="background: #ef4444; color: #fff; border: none; border-radius: 6px; padding: 12px 24px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background-color 0.2s; outline: none;">
                      Enviar opinión
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Suggested Products Section -->
          <div class="other-products" style="margin-top: 60px; border-top: 1px solid #e2e8f0; padding-top: 30px;">
            <h3 style="font-size: 18px; font-weight: 600; color: #0f172a; margin-bottom: 25px;">12 otros productos de la misma categoría:</h3>
            <div class="row" style="margin: 0 -10px;">
              @php
                $otherProducts = \App\Models\Product::with('images')
                  ->where('category_id', $product->category_id)
                  ->where('id', '!=', $product->id)
                  ->take(4)
                  ->get();
              @endphp
              @foreach($otherProducts as $other)
                @php
                  $otherImage = $other->images->where('is_primary', true)->first() ?? $other->images->first();
                  $otherImageUrl = $otherImage ? (Str::startsWith($otherImage->image_url, 'http') ? $otherImage->image_url : Storage::url($otherImage->image_url)) : '/tienda/img/mirage-logo-1534899548.jpg';
                @endphp
                <div class="col-6 col-md-3" style="padding: 0 10px;">
                  <div style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px; text-align: center; background: #fff; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0,0,0,0.05)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.02)';">
                    <a href="{{ route('tienda.product', $other->slug) }}" style="display: block; height: 130px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                      <img src="{{ $otherImageUrl }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    </a>
                    <h4 style="font-size: 14px; font-weight: 600; color: #334155; margin: 0 0 10px 0; height: 38px; overflow: hidden; line-height: 1.4; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                      <a href="{{ route('tienda.product', $other->slug) }}" style="text-decoration: none; color: inherit;">{{ $other->name }}</a>
                    </h4>
                    <div style="font-weight: 700; color: #ef4444; font-size: 16px;">
                      @if($other->discount_price)
                        ${{ number_format($other->discount_price, 2) }}
                      @else
                        ${{ number_format($other->price, 2) }}
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

        </div>
      </div>
      
    </div>
  </div>
</main>

<!-- Footer -->
<footer id="footer" style="background: #2d3748; color: #cbd5e0; padding: 40px 0; font-family: 'Montserrat', sans-serif;">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5 style="color: #fff; font-weight: 600; margin-bottom: 15px;">Acerca de Mirage</h5>
        <p style="font-size: 13px; line-height: 1.6;">Mirage es el fabricante número uno de aires acondicionados en México, comprometido con brindarte el mayor confort y ahorro energético en cada equipo.</p>
      </div>
      <div class="col-md-4">
        <h5 style="color: #fff; font-weight: 600; margin-bottom: 15px;">Enlaces rápidos</h5>
        <ul style="list-style: none; padding: 0; line-height: 2; font-size: 13px;">
          <li><a href="{{ route('tienda.index') }}" style="color: #cbd5e0; text-decoration: none;">Catálogo</a></li>
          <li><a href="#" style="color: #cbd5e0; text-decoration: none;">Distribuidores</a></li>
          <li><a href="#" style="color: #cbd5e0; text-decoration: none;">Contacto</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5 style="color: #fff; font-weight: 600; margin-bottom: 15px;">Atención al cliente</h5>
        <p style="font-size: 13px; line-height: 1.6; margin: 0;">Lunes a Viernes: 8:00 AM - 6:00 PM<br>Sábados: 9:00 AM - 1:00 PM</p>
      </div>
    </div>
    <hr style="border-color: #4a5568; margin-top: 30px; margin-bottom: 20px;">
    <div class="text-center" style="font-size: 12px; color: #a0aec0;">
      &copy; {{ date('Y') }} Mirage. Todos los derechos reservados.
    </div>
  </div>
</footer>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="/tienda_assets/themes/core.js" ></script>
<script src="/tienda_assets/themes/warehouse/assets/js/theme.js" ></script>
<script src="/tienda_assets/themes/warehouse/assets/js/custom.js" ></script>

@include('tienda.partials.modals')

<script>
const productVariants = @json($product->variants);
const baseProduct = {
    price: {{ $product->price ?: 0 }},
    discount_price: {{ $product->discount_price ?: 'null' }},
    sku: "{{ $product->sku }}"
};

function formatCurrency(val) {
    return '$' + parseFloat(val).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

function updateVariantDetails() {
    const variantId = $('#variant-select').val();
    $('#selected_variant_id').val(variantId);
    
    let price = baseProduct.price;
    let discountPrice = baseProduct.discount_price;
    let sku = baseProduct.sku;
    
    if (variantId) {
        const variant = productVariants.find(v => v.id == variantId);
        if (variant) {
            price = variant.price;
            discountPrice = variant.discount_price;
            sku = variant.sku || baseProduct.sku;
        }
    }
    
    $('#display-sku').text(sku || 'N/A');
    
    const rpElem = $('#display-regular-price');
    const dpElem = $('#display-discount-price');
    const badgeElem = $('#display-discount-badge');
    
    if (discountPrice && discountPrice > 0) {
        dpElem.text(formatCurrency(discountPrice)).show();
        rpElem.text(formatCurrency(price)).css({
            'font-size': '18px',
            'text-decoration': 'line-through',
            'color': '#94a3b8',
            'font-weight': '500'
        });
        const discountPct = Math.round(((price - discountPrice) / price) * 100);
        badgeElem.text('-' + discountPct + '%').show();
    } else {
        dpElem.hide();
        badgeElem.hide();
        rpElem.text(formatCurrency(price)).css({
            'font-size': '26px',
            'text-decoration': 'none',
            'color': '#0f172a',
            'font-weight': '700'
        });
    }
}

function changeDetailImage(imgSrc, element) {
    $('#main-product-detail-img').attr('src', imgSrc);
    $('.thumb-btn').removeClass('active').css('border-color', '#e2e8f0');
    $(element).addClass('active').css('border-color', '#ef4444');
}

function adjustDetailQty(change) {
    const input = $('#detail-qty-input');
    let val = parseInt(input.val()) || 1;
    val += change;
    const min = parseInt(input.attr('min')) || 1;
    const max = parseInt(input.attr('max')) || 99;
    if (val < min) val = min;
    if (val > max) val = max;
    input.val(val);
}

function switchTab(event, tabId) {
    event.preventDefault();
    // Hide all panes
    $('.mrg-panel').each(function() {
        $(this).css('display', 'none');
    });
    // Show the selected pane
    $('#' + tabId).css('display', 'block');
    
    // Update tab link styles
    $('.mrg-tab').removeClass('active-tab').css({
        'color': '#64748b',
        'border-bottom': 'none'
    });
    $(event.currentTarget).addClass('active-tab').css({
        'color': '#ef4444',
        'border-bottom': '2px solid #ef4444'
    });
}

function setSelectRating(val) {
    document.getElementById('review-rating-input').value = val;
    const stars = document.querySelectorAll('.star-select');
    stars.forEach(star => {
        const starVal = parseInt(star.getAttribute('data-value'));
        if (starVal <= val) {
            star.className = 'fa fa-star star-select';
        } else {
            star.className = 'fa fa-star-o star-select';
        }
    });
}

// Add validation to form submission to require variant if they exist
$('#add-to-cart-form').on('submit', function(e) {
    if (productVariants && productVariants.length > 0) {
        if (!$('#variant-select').val()) {
            e.preventDefault();
            alert('Por favor, selecciona una capacidad/modelo antes de añadir al carrito.');
            $('#variant-select').focus();
        }
    }
});

// On page load: force first tab visible (override any Bootstrap .tab-pane CSS)
$(document).ready(function() {
    // Hide all panes first (nullify any CSS conflicts)
    $('.mrg-panel').css('display', 'none');
    // Show description (default active)
    $('#tab-description').css('display', 'block');
    
    // Auto-open reviews tab if there's a success message
    @if(session('success'))
        $('#tab-description').css('display', 'none');
        $('#tab-reviews').css('display', 'block');
        $('.mrg-tab').css({ 'color': '#64748b', 'border-bottom': 'none' });
        $('a[onclick*="tab-reviews"]').css({ 'color': '#ef4444', 'border-bottom': '2px solid #ef4444' });
    @endif
});

</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("search-input");
    const searchResults = document.getElementById("search-results");
    const searchResultsList = document.getElementById("search-results-list");
    const searchLoading = document.getElementById("search-loading");
    let timeoutId;

    if (!searchInput) return;

    searchInput.addEventListener("input", function(e) {
        const query = e.target.value.trim();
        
        clearTimeout(timeoutId);

        if (query.length < 2) {
            searchResults.classList.add("hidden");
            return;
        }

        searchResults.classList.remove("hidden");
        searchResultsList.innerHTML = "";
        searchLoading.classList.remove("hidden");

        timeoutId = setTimeout(() => {
            fetch(`/buscar/autocomplete?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchLoading.classList.add("hidden");
                    searchResultsList.innerHTML = "";
                    
                    if (data.length === 0) {
                        searchResultsList.innerHTML = '<div class="p-4 text-sm text-gray-500 text-center">No se encontraron productos.</div>';
                        return;
                    }

                    data.forEach(product => {
                        const html = `
                            <a href="${product.url}" class="flex items-center p-3 hover:bg-gray-50 transition-colors group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-md overflow-hidden">
                                    ${product.image ? `<img src="${product.image}" class="w-full h-full object-cover">` : `<div class="w-full h-full flex items-center justify-center text-gray-400">...</div>`}
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
                        searchResultsList.insertAdjacentHTML("beforeend", html);
                    });
                })
                .catch(error => {
                    searchLoading.classList.add("hidden");
                    console.error("Error fetching search results:", error);
                });
        }, 300);
    });

    document.addEventListener("click", function(e) {
        const container = document.getElementById("autocomplete-container");
        if (container && !container.contains(e.target)) {
            searchResults.classList.add("hidden");
        }
    });
});
</script>
</body>

</html>
