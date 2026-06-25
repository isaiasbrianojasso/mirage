@extends('layouts.store')

@section('title', 'Finalizar Compra | Tienda Mirage')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto lg:max-w-none">
            <h1 class="sr-only">Checkout</h1>

            <form action="{{ route('checkout.store') }}" method="POST" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
                @csrf

                <!-- Lado Izquierdo: Formulario -->
                <div>
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Información de Contacto</h2>
                        <div class="mt-4">
                            <label for="customer_email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                            <div class="mt-1">
                                <input type="email" id="customer_email" name="customer_email" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h2 class="text-lg font-medium text-gray-900">Datos de Envío</h2>
                        <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                            
                            <div class="sm:col-span-2">
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                                <div class="mt-1">
                                    <input type="text" id="customer_name" name="customer_name" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700">Teléfono (Celular)</label>
                                <div class="mt-1">
                                    <input type="text" id="customer_phone" name="customer_phone" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">Dirección completa (Calle, número exterior/interior, colonia)</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_address" name="shipping_address" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div>
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700">Ciudad / Municipio</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_city" name="shipping_city" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div>
                                <label for="shipping_state" class="block text-sm font-medium text-gray-700">Estado</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_state" name="shipping_state" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div>
                                <label for="shipping_zip" class="block text-sm font-medium text-gray-700">Código Postal</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_zip" name="shipping_zip" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h2 class="text-lg font-medium text-gray-900">Método de Pago</h2>
                        <div class="mt-4">
                            <div class="bg-blue-50 border border-blue-200 rounded-md p-4 flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1 md:flex md:justify-between">
                                    <p class="text-sm text-blue-700">
                                        Actualmente los pedidos se registran para <strong>pago contra entrega o transferencia bancaria</strong>. Un agente se comunicará contigo para acordar el pago tras confirmar tu pedido.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notas del pedido (Opcional)</label>
                            <div class="mt-1">
                                <textarea id="notes" name="notes" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lado Derecho: Resumen del Pedido -->
                <div class="mt-10 lg:mt-0">
                    <h2 class="text-lg font-medium text-gray-900">Resumen de tu compra</h2>

                    <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h3 class="sr-only">Artículos en tu carrito</h3>
                        <ul role="list" class="divide-y divide-gray-200">
                            @php $subtotal = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php $subtotal += $item['price'] * $item['quantity']; @endphp
                                <li class="flex py-6 px-4 sm:px-6">
                                    <div class="flex-shrink-0">
                                        @if($item['image_url'])
                                            <img src="{{ Storage::url($item['image_url']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 rounded-md object-center object-cover">
                                        @else
                                            <div class="w-20 h-20 rounded-md bg-gray-200"></div>
                                        @endif
                                    </div>
                                    <div class="ml-6 flex-1 flex flex-col">
                                        <div class="flex">
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-sm font-medium text-gray-900">
                                                    {{ $item['name'] }}
                                                </h4>
                                                <p class="mt-1 text-sm text-gray-500">Cantidad: {{ $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex-1 flex items-end justify-between">
                                            <p class="text-sm font-medium text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                        <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm text-gray-600">Subtotal</dt>
                                <dd class="text-sm font-medium text-gray-900">${{ number_format($subtotal, 2) }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm text-gray-600">Envío</dt>
                                <dd class="text-sm font-medium text-gray-900">Por acordar</dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                <dt class="text-base font-medium text-gray-900">Total a Pagar</dt>
                                <dd class="text-base font-medium text-gray-900">${{ number_format($subtotal, 2) }}</dd>
                            </div>
                        </dl>

                        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                            <button type="submit" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">
                                Confirmar Pedido
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
