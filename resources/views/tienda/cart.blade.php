@extends('layouts.legacy')

@section('title', 'Carrito de Compras | Tienda Mirage')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tu Carrito de Compras</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
                
                <!-- Lista de Productos -->
                <section aria-labelledby="cart-heading" class="lg:col-span-8">
                    <h2 id="cart-heading" class="sr-only">Artículos en tu carrito</h2>

                    <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200 bg-white shadow-sm rounded-lg overflow-hidden">
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach($cart as $id => $item)
                            @php
                                $itemSubtotal = $item['price'] * $item['quantity'];
                                $subtotal += $itemSubtotal;
                            @endphp
                            <li class="flex py-6 sm:py-10 px-4 sm:px-6">
                                <div class="flex-shrink-0">
                                    @if($item['image_url'])
                                        @php
                                            $cartImgUrl = \Illuminate\Support\Str::startsWith($item['image_url'], 'http') ? $item['image_url'] : Storage::url($item['image_url']);
                                        @endphp
                                        <img src="{{ $cartImgUrl }}" alt="{{ $item['name'] }}" class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                                    @else
                                        <div class="w-24 h-24 rounded-md bg-gray-200 flex items-center justify-center sm:w-32 sm:h-32">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                                    <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                        <div>
                                            <div class="flex justify-between">
                                                <h3 class="text-lg font-medium text-gray-700 hover:text-gray-800">
                                                    <a href="{{ route('tienda.product', $item['slug']) }}">{{ $item['name'] }}</a>
                                                </h3>
                                            </div>
                                            <p class="mt-1 text-sm font-medium text-gray-900">${{ number_format($item['price'], 2) }}</p>
                                        </div>

                                        <div class="mt-4 sm:mt-0 sm:pr-9 flex flex-col sm:items-end">
                                            <!-- Actualizar Cantidad -->
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center">
                                                @csrf
                                                @method('PUT')
                                                <label for="quantity-{{ $id }}" class="sr-only">Cantidad, {{ $item['name'] }}</label>
                                                <input type="number" id="quantity-{{ $id }}" name="quantity" value="{{ $item['quantity'] }}" min="1" class="max-w-[80px] rounded-md border border-gray-300 text-left text-base font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
                                                <button type="submit" class="ml-2 text-sm text-indigo-600 hover:text-indigo-500">Actualizar</button>
                                            </form>

                                            <!-- Eliminar Producto -->
                                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">
                                                    <span>Eliminar</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <p class="mt-4 flex text-sm text-gray-700 space-x-2">
                                        <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span>En stock</span>
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                    <div class="mt-6 flex justify-end">
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">
                                Vaciar Carrito Completo
                            </button>
                        </form>
                    </div>
                </section>

                <!-- Resumen (Order summary) -->
                <section aria-labelledby="summary-heading" class="mt-16 bg-white rounded-lg px-4 py-6 shadow-sm sm:p-6 lg:p-8 lg:mt-0 lg:col-span-4 border border-gray-200">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Resumen del Pedido</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">${{ number_format($subtotal, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>Envío Estimado</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">Gratis</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Total a Pagar</dt>
                            <dd class="text-base font-medium text-gray-900">${{ number_format($subtotal, 2) }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="{{ route('checkout.index') }}" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 text-center block">
                            Proceder al Pago
                        </a>
                    </div>
                </section>
            </div>
        @else
            <!-- Carrito Vacío -->
            <div class="text-center bg-white shadow-sm rounded-lg border border-gray-200 py-16 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="mt-4 text-2xl font-bold text-gray-900">Tu carrito está vacío</h2>
                <p class="mt-2 text-gray-500">Parece que aún no has agregado productos a tu carrito de compras.</p>
                <a href="{{ route('tienda.index') }}" class="mt-6 inline-flex bg-indigo-600 border border-transparent rounded-md py-3 px-8 items-center justify-center text-base font-medium text-white hover:bg-indigo-700">
                    Ir de Compras
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
