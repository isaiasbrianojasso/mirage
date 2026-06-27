@php
    if (!isset($products)) {
        $compareIds = session()->get('compare_list', []);
        $products = [];
        if (!empty($compareIds)) {
            $products = \App\Models\Product::with('images')->whereIn('id', $compareIds)->get();
        }
    }
@endphp
<div id="iqitcompare-floating-wrapper">
    <div id="iqitcompare-floating" style="position: fixed; bottom: 0; right: 20px; background: #fff; z-index: 9999; padding: 10px 20px; box-shadow: 0 -2px 10px rgba(0,0,0,0.15); border-top-left-radius: 8px; border-top-right-radius: 8px; {{ count($products) > 0 ? '' : 'display: none;' }}">
        <a href="{{ route('compare.index') }}" style="display: flex; align-items: center; text-decoration: none; color: #333; font-weight: bold;">
            <i class="fa fa-refresh" aria-hidden="true" style="margin-right: 5px;"></i>
            <span>Comparar (<span id="iqitcompare-nb">{{ count($products) }}</span>)</span>
            @foreach($products as $product)
                @php
                    $imageUrl = $product->images->count() > 0 ? $product->images->first()->image_url : null;
                    if ($imageUrl) {
                        $imageUrl = \Illuminate\Support\Str::startsWith($imageUrl, 'http') ? $imageUrl : Storage::url($imageUrl);
                    } else {
                        // Data URI 1x1 gray pixel
                        $imageUrl = 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==';
                    }
                @endphp
                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="js-iqitcompare-product-{{ $product->id }}" style="width: 30px; height: 30px; object-fit: cover; margin-left: 4px; display: inline-block;">
            @endforeach
        </a>
    </div>
</div>
