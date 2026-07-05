@extends('layouts.legacy')

@section('title', '¡Pedido Confirmado! - Mirage')

@section('content')
<!-- Contenedor Principal con Fondo Vibrante y Gradiente -->
<div class="min-h-screen py-16 relative overflow-hidden bg-gradient-to-br from-indigo-50 via-white to-indigo-100 flex items-center justify-center">
    
    <!-- Decoración de Fondo Abstracta -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-gradient-to-br from-indigo-200 to-purple-200 blur-3xl opacity-40 mix-blend-multiply animate-blob"></div>
        <div class="absolute top-[10%] -right-[10%] w-[40%] h-[40%] rounded-full bg-gradient-to-br from-pink-200 to-indigo-200 blur-3xl opacity-40 mix-blend-multiply animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[60%] h-[60%] rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 blur-3xl opacity-40 mix-blend-multiply animate-blob animation-delay-4000"></div>
    </div>

    <!-- Contenido Principal - Glassmorphism -->
    <div class="relative z-10 w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-2xl rounded-3xl overflow-hidden transform transition-all hover:scale-[1.01] duration-500">
            
            <!-- Encabezado de Éxito -->
            <div class="px-6 py-10 sm:px-12 text-center bg-gradient-to-r from-indigo-600/5 to-purple-600/5 border-b border-indigo-100/50 relative overflow-hidden">
                <!-- Efecto de celebración (Micro-animación en el ícono) -->
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-tr from-green-400 to-emerald-500 shadow-lg shadow-green-500/30 mb-6 transform hover:rotate-12 transition duration-300">
                    <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                
                <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-700 to-purple-700 mb-2">
                    ¡Gracias por tu compra!
                </h2>
                <p class="mt-2 text-lg text-gray-600 font-medium">
                    Tu pedido ha sido procesado y confirmado con éxito.
                </p>
                <div class="mt-4 inline-flex items-center px-4 py-1.5 rounded-full bg-indigo-50 border border-indigo-100">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                    <span class="text-sm font-semibold text-indigo-700">Comprobante enviado a: {{ $order->customer_email }}</span>
                </div>
            </div>

            <!-- Detalles del Pedido -->
            <div class="px-6 py-8 sm:px-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Resumen a la izquierda -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-1">Referencia del Pedido</h3>
                            <p class="text-2xl font-black text-gray-900 tracking-tight">{{ $order->reference }}</p>
                        </div>

                        <div class="bg-gray-50/50 rounded-2xl p-5 border border-gray-100">
                            <h3 class="text-sm font-bold text-gray-900 mb-3">Información de Envío</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                <span class="font-semibold text-gray-800">{{ $order->customer_name }}</span><br>
                                {{ $order->shipping_address }}<br>
                                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}<br>
                                {{ $order->customer_phone }}
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 mb-2">Método de Pago</h3>
                            <div class="flex items-center text-sm text-gray-600">
                                @if($order->payment_method === 'paypal')
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106z"/></svg>
                                    Pago vía PayPal
                                @else
                                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Pago en Efectivo (Contra Entrega)
                                @endif
                                
                                <span class="ml-4 px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $order->payment_status === 'paid' ? 'Pagado' : 'Pendiente' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Resumen de Costos a la derecha -->
                    <div class="bg-gradient-to-b from-gray-50 to-white rounded-3xl p-6 shadow-inner border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Resumen de tu Compra</h3>
                        
                        <ul role="list" class="divide-y divide-gray-100 overflow-y-auto max-h-48 pr-2 custom-scrollbar">
                            @foreach($order->items as $item)
                                <li class="py-3 flex justify-between items-center group">
                                    <div class="flex items-center min-w-0 flex-1">
                                        <div class="h-10 w-10 bg-indigo-50 text-indigo-500 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 group-hover:bg-indigo-100 transition-colors">
                                            x{{ $item->quantity }}
                                        </div>
                                        <p class="ml-3 text-sm font-medium text-gray-800 truncate" title="{{ $item->product_name }}">
                                            {{ $item->product_name }}
                                        </p>
                                    </div>
                                    <p class="ml-4 text-sm font-semibold text-gray-900 shrink-0">
                                        ${{ number_format($item->price * $item->quantity, 2) }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>

                        <div class="pt-4 mt-4 border-t border-gray-100 space-y-3">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-medium">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Envío</span>
                                <span class="font-medium">Por Acordar</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 mt-3 border-t border-gray-200">
                                <span class="text-base font-bold text-gray-900">Total a Pagar</span>
                                <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                                    ${{ number_format($order->total_amount, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer y Acciones -->
            <div class="px-6 py-8 sm:px-12 bg-gray-50/80 border-t border-gray-100 text-center sm:flex sm:items-center sm:justify-between">
                <p class="text-sm text-gray-500 mb-4 sm:mb-0 sm:text-left">
                    Conserva tu número de referencia para cualquier aclaración o seguimiento.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    @auth
                        <a href="{{ route('customer.orders') }}" class="inline-flex justify-center items-center px-6 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 hover:shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ver mis pedidos
                        </a>
                    @endauth
                    <a href="{{ route('tienda.index') }}" class="inline-flex justify-center items-center px-6 py-2.5 border border-transparent shadow-lg shadow-indigo-500/30 text-sm font-bold rounded-xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 hover:scale-105 transform transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Seguir Comprando
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* CSS para la scrollbar del resumen de compra */
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 10px; }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb { background-color: #d1d5db; }
    
    /* Animación de Blob Background */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endsection
