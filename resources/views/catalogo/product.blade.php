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
                                <img src="{{ $imageUrl }}" id="main-product-img" style="width: 100%; height: auto; border: 1px solid #eaeaea;" alt="{{ $product->name }}">
                                
                                <div class="thumbnails mt-3" style="display: flex; gap: 10px; overflow-x: auto;">
                                    @foreach($product->images as $img)
                                        @php
                                            $thumbUrl = Str::startsWith($img->image_url, 'http') ? $img->image_url : Storage::url($img->image_url);
                                        @endphp
                                        <img src="{{ $thumbUrl }}" onclick="document.getElementById('main-product-img').src = this.src;" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 1px solid #eaeaea;" alt="{{ $product->name }}">
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Columna Derecha: Información del Producto -->
                        <div class="col-md-6 summary entry-summary">
                            <h1 class="product_title entry-title" style="font-size: 28px; font-weight: 700; color: #222; margin-bottom: 20px;">{{ $product->name }}</h1>
                            
                            <div class="woocommerce-product-details__short-description" style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                                @if($product->short_description)
                                    <p>{{ $product->short_description }}</p>
                                @endif
                                
                                @if($product->specifications && count($product->specifications) > 0)
                                    <ul style="list-style-type: none; padding-left: 0;">
                                    @foreach(array_slice($product->specifications, 0, 4) as $spec)
                                        <li><i class="fa fa-check" style="color: #4CAF50; margin-right: 8px;"></i>{{ $spec }}</li>
                                    @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Documentos del Producto (Original Site Style) -->
                            @if($product->documents && $product->documents->count() > 0)
                            <div class="product-documents" style="margin-top: 40px; padding: 20px; background: #f9f9f9; border: 1px solid #eaeaea;">
                                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 15px;">Documentos del Producto</h3>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    @foreach($product->documents as $doc)
                                    <li style="margin-bottom: 10px;">
                                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" style="color: #e62228; text-decoration: none; font-weight: 500; display: flex; align-items: center;">
                                            <i class="fa fa-file-pdf-o" style="margin-right: 10px; font-size: 18px;"></i> {{ $doc->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Pestañas de Especificaciones -->
                    <div class="woocommerce-tabs wc-tabs-wrapper" style="margin-top: 60px;">
                        @if($product->variants && $product->variants->count() > 0)
                            <h2 style="font-size: 24px; font-weight: 700; border-bottom: 2px solid #222; padding-bottom: 10px; margin-bottom: 20px;">Especificaciones del Producto</h2>
                            
                            <ul class="tabs wc-tabs" role="tablist" style="padding: 0; margin: 0 0 20px 0; list-style: none; border-bottom: 1px solid #eaeaea; display: flex;">
                                @foreach($product->variants as $index => $variant)
                                    <li class="{{ $index === 0 ? 'active' : '' }}" id="tab-title-{{ $variant->id }}" role="tab" aria-controls="tab-{{ $variant->id }}" style="margin-right: 5px;">
                                        <a href="#tab-{{ $variant->id }}" class="variant-tab-link" data-target="tab-panel-{{ $variant->id }}" style="display: block; padding: 10px 20px; text-decoration: none; color: {{ $index === 0 ? '#222' : '#666' }}; font-weight: 600; background: {{ $index === 0 ? '#f9f9f9' : 'transparent' }}; border: 1px solid #eaeaea; border-bottom: none; border-radius: 3px 3px 0 0;">{{ $variant->name }}</a>
                                    </li>
                                @endforeach
                            </ul>

                            @foreach($product->variants as $index => $variant)
                                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--{{ $variant->id }} panel entry-content wc-tab variant-panel" id="tab-panel-{{ $variant->id }}" role="tabpanel" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                                    @if($variant->attributes && is_array($variant->attributes) && count($variant->attributes) > 0)
                                        <table class="woocommerce-product-attributes shop_attributes" style="width: 100%; border-collapse: collapse; border: 1px solid #eaeaea;">
                                            <tbody>
                                                @foreach($variant->attributes as $key => $value)
                                                    <tr style="border-bottom: 1px solid #eaeaea; background: {{ $loop->iteration % 2 == 0 ? '#fcfcfc' : 'transparent' }};">
                                                        <th class="woocommerce-product-attributes-item__label" style="padding: 12px 20px; width: 30%; font-weight: 600; color: #333; text-align: left; border-right: 1px solid #eaeaea;">{{ mb_strtoupper(str_replace('_', ' ', $key)) }}</th>
                                                        <td class="woocommerce-product-attributes-item__value" style="padding: 12px 20px; color: #666;"><p style="margin: 0;">{{ is_array($value) ? implode(', ', $value) : $value }}</p></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No hay especificaciones detalladas para este modelo.</p>
                                    @endif
                                </div>
                            @endforeach

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const links = document.querySelectorAll('.variant-tab-link');
                                    links.forEach(link => {
                                        link.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            // Reset all links
                                            links.forEach(l => {
                                                l.style.color = '#666';
                                                l.style.background = 'transparent';
                                                l.parentElement.classList.remove('active');
                                            });
                                            // Set active link
                                            this.style.color = '#222';
                                            this.style.background = '#f9f9f9';
                                            this.parentElement.classList.add('active');

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
