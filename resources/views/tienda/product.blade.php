@extends('layouts.store')

@section('title', $product->name . ' | Tienda Mirage')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            
            <!-- Image gallery -->
            <div class="flex flex-col-reverse">
                <!-- Image selector -->
                <div class="mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                    <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                        @foreach($product->images as $index => $image)
                            <button id="tabs-1-tab-{{ $index }}" class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-offset-4" aria-controls="tabs-1-panel-{{ $index }}" role="tab" type="button" onclick="changeImage('{{ Storage::url($image->image_url) }}')">
                                <span class="sr-only">Imagen {{ $index + 1 }}</span>
                                <span class="absolute inset-0 rounded-md overflow-hidden">
                                    <img src="{{ Storage::url($image->image_url) }}" alt="" class="w-full h-full object-center object-cover">
                                </span>
                                <!-- Selected state ring -->
                                <span class="ring-transparent absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none" aria-hidden="true"></span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden flex items-center justify-center bg-gray-100 h-96">
                    @php
                        $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
                    @endphp
                    @if($primaryImage)
                        <img id="main-product-image" src="{{ Storage::url($primaryImage->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover sm:rounded-lg">
                    @else
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    @endif
                </div>
            </div>

            <!-- Product info -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <nav aria-label="Breadcrumb" class="mb-4">
                    <ol role="list" class="flex items-center space-x-2 text-sm text-gray-500">
                        <li>
                            <a href="{{ route('tienda.index') }}" class="hover:text-gray-900">Catálogo</a>
                        </li>
                        <li>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="w-4 h-5 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </li>
                        @if($product->category)
                        <li>
                            <a href="{{ route('tienda.category', $product->category->slug) }}" class="hover:text-gray-900">{{ $product->category->name }}</a>
                        </li>
                        <li>
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="w-4 h-5 text-gray-300">
                                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                            </svg>
                        </li>
                        @endif
                        <li class="text-gray-900">{{ $product->name }}</li>
                    </ol>
                </nav>

                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $product->name }}</h1>
                @if($product->sku)
                    <p class="text-sm text-gray-500 mt-2">SKU: {{ $product->sku }}</p>
                @endif

                <div class="mt-4 flex items-end">
                    @if($product->sale_price)
                        <p class="text-3xl font-bold text-red-600">${{ number_format($product->sale_price, 2) }}</p>
                        <p class="ml-4 text-xl font-medium text-gray-500 line-through">${{ number_format($product->price, 2) }}</p>
                    @else
                        <p class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                    @endif
                </div>

                <!-- Stock Badge -->
                <div class="mt-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->stock > 0 ? 'Disponible en Stock (' . $product->stock . ')' : 'Agotado Temporalmente' }}
                    </span>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Descripción</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="mt-10">
                    <form action="{{ route('cart.add') }}" method="POST" class="flex sm:flex-col1">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="mr-4 flex items-center border border-gray-300 rounded-md">
                            <label for="quantity" class="sr-only">Cantidad</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 p-3 text-center rounded-md border-0 focus:ring-0 text-gray-700 font-medium" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        </div>

                        <button type="submit" class="flex-1 bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 sm:w-full transition-colors {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            Agregar al carrito
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function changeImage(url) {
        document.getElementById('main-product-image').src = url;
    }
</script>
@endsection
