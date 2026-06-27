<?php
$index = file_get_contents('resources/views/tienda/index.blade.php');
$topEnd = strpos($index, '<div id="content-wrapper"');
$top = substr($index, 0, $topEnd);
$bottomStart = strpos($index, '</div> <!-- end inner-wrapper -->');
if ($bottomStart === false) {
    $bottomStart = strpos($index, '<footer id="footer"');
    if ($bottomStart === false) {
        $bottomStart = strpos($index, '<footer');
    }
}
$bottom = substr($index, $bottomStart);

// Generar wishlist.blade.php
$wishlistContent = $top . '
    <div id="content-wrapper" class="container" style="padding-top: 40px; padding-bottom: 80px;">
        <h1 style="font-size: 28px; font-weight: 700; color: #0f172a; margin-bottom: 30px;">Mi Lista de Deseos</h1>
        
        @if(count($wishlistItems) > 0)
        <div class="row">
            @foreach($wishlistItems as $item)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: #fff; height: 100%; display: flex; flex-direction: column;">
                    <a href="{{ route(\'tienda.product\', $item->product->slug) }}" style="display: block; text-decoration: none;">
                        <div style="height: 200px; padding: 20px; display: flex; align-items: center; justify-content: center; background: #f8fafc;">
                            @if($item->product->images->count() > 0)
                                <img src="{{ Str::startsWith($item->product->images->first()->image_url, \'http\') ? $item->product->images->first()->image_url : Storage::url($item->product->images->first()->image_url) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            @else
                                <i class="fa fa-image" style="font-size: 48px; color: #cbd5e1;"></i>
                            @endif
                        </div>
                        <div style="padding: 15px; flex-grow: 1;">
                            <h3 style="font-size: 15px; font-weight: 600; color: #0f172a; margin: 0 0 10px 0; line-height: 1.3;">{{ $item->product->name }}</h3>
                            <div style="font-size: 16px; font-weight: 700; color: #ef4444;">${{ number_format($item->product->price, 2) }}</div>
                        </div>
                    </a>
                    <div style="padding: 15px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between;">
                        <form action="{{ route(\'cart.add\') }}" method="POST" style="margin: 0;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" style="background: #10b981; color: white; border: none; padding: 8px 12px; border-radius: 4px; font-size: 13px; font-weight: 600; cursor: pointer;">
                                <i class="fa fa-shopping-cart"></i> Agregar
                            </button>
                        </form>
                        <form action="{{ route(\'wishlist.remove\', $item->product->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method(\'DELETE\')
                            <button type="submit" style="background: #ef4444; color: white; border: none; padding: 8px 12px; border-radius: 4px; font-size: 13px; cursor: pointer;">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align: center; padding: 60px 20px; background: #fff; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <i class="fa fa-heart-o" style="font-size: 64px; color: #94a3b8; margin-bottom: 20px;"></i>
            <h2 style="font-size: 20px; font-weight: 600; color: #334155; margin-bottom: 10px;">Tu lista de deseos está vacía</h2>
            <p style="color: #64748b; margin-bottom: 25px;">Agrega productos a tu lista para poder compararlos y comprarlos más tarde.</p>
            <a href="{{ route(\'tienda.index\') }}" style="background: #ef4444; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 600;">Ir a comprar</a>
        </div>
        @endif
    </div>
' . $bottom;

file_put_contents('resources/views/tienda/wishlist.blade.php', $wishlistContent);

// Generar compare.blade.php
$compareContent = $top . '
    <div id="content-wrapper" class="container" style="padding-top: 40px; padding-bottom: 80px;">
        <h1 style="font-size: 28px; font-weight: 700; color: #0f172a; margin-bottom: 30px;">Comparador de Productos</h1>
        
        @if(count($products) > 0)
        <div style="overflow-x: auto; background: #fff; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
            <table style="width: 100%; min-width: 800px; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 20px; width: 20%; background: #f8fafc; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0;">Características</th>
                        @foreach($products as $product)
                        <th style="padding: 20px; text-align: center; width: {{ 80 / count($products) }}%; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0; vertical-align: top;">
                            <div style="height: 150px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                                @if($product->images->count() > 0)
                                    <img src="{{ Str::startsWith($product->images->first()->image_url, \'http\') ? $product->images->first()->image_url : Storage::url($product->images->first()->image_url) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                @else
                                    <i class="fa fa-image" style="font-size: 48px; color: #cbd5e1;"></i>
                                @endif
                            </div>
                            <h3 style="font-size: 16px; font-weight: 600; color: #0f172a; margin: 0 0 10px 0; line-height: 1.3;">{{ $product->name }}</h3>
                            <div style="font-size: 18px; font-weight: 700; color: #ef4444; margin-bottom: 15px;">${{ number_format($product->price, 2) }}</div>
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <form action="{{ route(\'cart.add\') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" style="background: #10b981; color: white; border: none; padding: 8px 12px; border-radius: 4px; font-size: 13px; font-weight: 600; cursor: pointer;">
                                        Agregar
                                    </button>
                                </form>
                                <form action="{{ route(\'compare.remove\', $product->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method(\'DELETE\')
                                    <button type="submit" style="background: #ef4444; color: white; border: none; padding: 8px 12px; border-radius: 4px; font-size: 13px; cursor: pointer;">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 15px 20px; font-weight: 600; color: #475569; background: #f8fafc; border-bottom: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;">Categoría</td>
                        @foreach($products as $product)
                        <td style="padding: 15px 20px; text-align: center; border-bottom: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;">{{ $product->category ? $product->category->name : \'-\' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td style="padding: 15px 20px; font-weight: 600; color: #475569; background: #f8fafc; border-bottom: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;">SKU</td>
                        @foreach($products as $product)
                        <td style="padding: 15px 20px; text-align: center; border-bottom: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;">{{ $product->sku ?: \'-\' }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td style="padding: 15px 20px; font-weight: 600; color: #475569; background: #f8fafc; border-bottom: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;">Características Principales</td>
                        @foreach($products as $product)
                        <td style="padding: 15px 20px; border-bottom: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; vertical-align: top; text-align: left;">
                            @if($product->specifications && count($product->specifications) > 0)
                                <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #475569;">
                                    @foreach(array_slice($product->specifications, 0, 8) as $spec)
                                        <li style="margin-bottom: 5px;">{{ $spec }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span style="color: #94a3b8; text-align: center; display: block;">Sin especificaciones</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        @else
        <div style="text-align: center; padding: 60px 20px; background: #fff; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <i class="fa fa-random" style="font-size: 64px; color: #94a3b8; margin-bottom: 20px;"></i>
            <h2 style="font-size: 20px; font-weight: 600; color: #334155; margin-bottom: 10px;">No hay productos para comparar</h2>
            <p style="color: #64748b; margin-bottom: 25px;">Navega por la tienda y agrega productos a la tabla comparativa para ver sus diferencias.</p>
            <a href="{{ route(\'tienda.index\') }}" style="background: #3b82f6; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 600;">Ir a comprar</a>
        </div>
        @endif
    </div>
' . $bottom;

file_put_contents('resources/views/tienda/compare.blade.php', $compareContent);
echo "Vistas creadas correctamente\n";
