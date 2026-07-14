@include('components.x-header')
<body class="product-template-default single single-product postid-{{ $product->id }} wp-theme-genesis wp-child-theme-digital-pro theme-genesis woocommerce woocommerce-page woocommerce-no-js custom-header header-image header-full-width full-width-content genesis-breadcrumbs-hidden genesis-footer-widgets-visible elementor-default" itemscope itemtype="https://schema.org/WebPage">
<div class="site-container">
    @include('components.x-menu')
    
    <div class="site-inner">
        <div class="content-sidebar-wrap">
            <main class="content" id="genesis-content">
                <div class="woocommerce-notices-wrapper"></div>
                
                <div class="product type-product status-publish has-post-thumbnail">
                    
                    <div class="row" style="margin-top: 40px;">
                        <!-- Columna Izquierda: Galería de Imágenes -->
                        <div class="col-md-6 woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" style="padding-right: 30px;">
                            <div class="woocommerce-product-gallery__wrapper">
                                @php
                                  $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                                  $imageUrl = $primaryImage ? (Str::startsWith($primaryImage->image_url, 'http') ? $primaryImage->image_url : Storage::url($primaryImage->image_url)) : '/tienda_assets/img/p/mx-default-home_default.jpg';
                                @endphp
                                <img src="{{ $imageUrl }}" id="main-product-img" style="width: 100%; height: auto;" alt="{{ $product->name }}">
                                
                                <div class="thumbnails mt-3" style="display: flex; gap: 10px; overflow-x: auto;">
                                    @foreach($product->images as $img)
                                        @php
                                            $thumbUrl = Str::startsWith($img->image_url, 'http') ? $img->image_url : Storage::url($img->image_url);
                                        @endphp
                                        <img src="{{ $thumbUrl }}" onclick="document.getElementById('main-product-img').src = this.src;" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;" alt="{{ $product->name }}">
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha: Información del Producto -->
                        <div class="col-md-6 summary entry-summary">
                            <h1 class="product_title entry-title" style="font-size: 28px; font-weight: 700; color: #222; margin-bottom: 20px;">{{ $product->name }}</h1>
                            
                            <div class="woocommerce-product-details__short-description" style="color: #666; font-size: 14px; line-height: 1.8; margin-bottom: 20px;">
                                @if($product->short_description)
                                    <p>{{ $product->short_description }}</p>
                                @endif
                                
                                @if($product->specifications && count($product->specifications) > 0)
                                    <ul style="list-style-type: none; padding-left: 0; margin-top: 15px;">
                                    @foreach(array_slice($product->specifications, 0, 4) as $spec)
                                        <li><i class="fa fa-check" style="color: #4CAF50; margin-right: 8px;"></i>{{ $spec }}</li>
                                    @endforeach
                                    </ul>
                                @endif
                                
                                @if($product->variants && $product->variants->count() > 0)
                                    <p style="margin-top: 20px; color: #777; font-size: 13px;">Modelos: {{ implode(', ', $product->variants->pluck('name')->toArray()) }}.</p>
                                @endif
                            </div>

                            <!-- Documentos del Producto (Original Site Style) -->
                            @if($product->documents && $product->documents->count() > 0)
                            <div class="product-documents" style="margin-top: 30px;">
                                <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 10px; color: #222;">Documentos del Producto</h3>
                                <div style="border: 1px solid #ccc; border-radius: 2px;">
                                    <div style="padding: 10px 15px; border-bottom: 1px solid #ccc; background: #fff; font-weight: bold; font-size: 12px; color: #555;">
                                        ▾ PDF
                                    </div>
                                    <div style="padding: 15px; background: #fff;">
                                        <ul style="list-style: none; padding: 0; margin: 0;">
                                            @foreach($product->documents as $doc)
                                            <li style="margin-bottom: 8px;">
                                                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" style="color: #333; text-decoration: none; font-size: 13px;">
                                                    {{ $product->name }} - {{ $doc->title }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Pestañas de Especificaciones -->
                    <div class="woocommerce-tabs wc-tabs-wrapper" style="margin-top: 60px;">
                        @if($product->variants && $product->variants->count() > 0)
                            <h2 style="font-size: 24px; font-weight: 800; margin-bottom: 20px; color: #222; letter-spacing: -0.5px;">Especificaciones del producto</h2>
                            
                            <!-- Tabs Navigation -->
                            <div class="su-tabs-nav" style="display: flex; flex-wrap: wrap; margin-bottom: 0;">
                                @foreach($product->variants as $index => $variant)
                                    <div class="variant-tab-link {{ $index === 0 ? 'active' : '' }}" data-target="tab-panel-{{ $variant->id }}" style="padding: 10px 15px; font-size: 11px; cursor: pointer; color: #555; background: {{ $index === 0 ? '#ebebeb' : '#f2f2f2' }}; border: 1px solid #e5e5e5; border-bottom: none; margin-right: 4px;">
                                        {{ mb_strtoupper($variant->name) }}
                                    </div>
                                @endforeach
                            </div>

                            <!-- Tabs Content -->
                            <div class="su-tabs-panes" style="background: #ebebeb; padding: 15px; border: 1px solid #e5e5e5; border-top: none;">
                                @foreach($product->variants as $index => $variant)
                                    <div class="variant-panel" id="tab-panel-{{ $variant->id }}" style="display: {{ $index === 0 ? 'block' : 'none' }}; background: #fff;">
                                        @if($variant->attributes && is_array($variant->attributes) && count($variant->attributes) > 0)
                                            <table class="woocommerce-product-attributes shop_attributes" style="width: 100%; border-collapse: collapse; border: 1px solid #eaeaea; font-size: 11px; font-family: sans-serif;">
                                                <thead>
                                                    <tr style="background: #e6e6e6;">
                                                        <th style="padding: 15px; border: 1px solid #eaeaea; width: 40%;"></th>
                                                        <th style="padding: 15px; border: 1px solid #eaeaea; width: 20%; text-align: center;"></th>
                                                        <th style="padding: 15px; border: 1px solid #eaeaea; text-align: center; color: #333; font-weight: 700;">{{ mb_strtoupper($variant->name) }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($variant->attributes as $key => $attr)
                                                        @php
                                                            // Fallback for old key-value data
                                                            if (!is_array($attr)) {
                                                                $attr = ['name' => str_replace('_', ' ', $key), 'unit' => '-', 'value' => $attr];
                                                            }
                                                        @endphp
                                                        <tr style="border-bottom: 1px solid #eaeaea; background: {{ $loop->iteration % 2 == 0 ? '#fff' : '#fcfcfc' }};">
                                                            <th class="woocommerce-product-attributes-item__label" style="padding: 12px 15px; text-align: right; color: #555; font-weight: 600; text-transform: uppercase; border-right: 1px solid #eaeaea;">{{ $attr['name'] ?? '' }}</th>
                                                            <td style="padding: 12px 15px; text-align: center; color: #555; font-weight: 600; border-right: 1px solid #eaeaea;">{{ !empty($attr['unit']) ? $attr['unit'] : '-' }}</td>
                                                            <td class="woocommerce-product-attributes-item__value" style="padding: 12px 15px; text-align: center; color: #333;"><p style="margin: 0;">{{ is_array($attr['value']) ? implode(', ', $attr['value']) : ($attr['value'] ?? '') }}</p></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p style="padding: 20px;">No hay especificaciones detalladas para este modelo.</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const links = document.querySelectorAll('.variant-tab-link');
                                    links.forEach(link => {
                                        link.addEventListener('click', function(e) {
                                            // Reset all links
                                            links.forEach(l => {
                                                l.style.background = '#f2f2f2';
                                                l.classList.remove('active');
                                            });
                                            // Set active link
                                            this.style.background = '#ebebeb';
                                            this.classList.add('active');

                                            // Hide all panels
                                            document.querySelectorAll('.variant-panel').forEach(panel => {
                                                panel.style.display = 'none';
                                            });
                                            // Show target panel
                                            const targetId = this.getAttribute('data-target');
                                            document.getElementById(targetId).style.display = 'block';
                                        });
                                    });
                                });
                            </script>
                        @elseif($product->specifications && count($product->specifications) > 0)
                            <h2 style="font-size: 24px; font-weight: 700; border-bottom: 2px solid #222; padding-bottom: 10px; margin-bottom: 20px;">Especificaciones Técnicas</h2>
                            <table class="woocommerce-product-attributes shop_attributes" style="width: 100%; border-collapse: collapse; border: 1px solid #eaeaea;">
                                <tbody>
                                    @foreach($product->specifications as $spec)
                                        <tr style="border-bottom: 1px solid #eaeaea; background: {{ $loop->iteration % 2 == 0 ? '#fcfcfc' : 'transparent' }};">
                                            <td style="padding: 12px 20px; color: #666;"><p style="margin: 0;">{{ $spec }}</p></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

            </main>
        </div>
    </div>
    
    @include('components.x-legacy-footer')
</div>
</body>
</html>
