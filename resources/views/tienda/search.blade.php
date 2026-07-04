@extends('layouts.legacy')

@section('title', 'Resultado de búsquedas')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('tienda.index') }}" class="hover:text-indigo-600 transition-colors">Inicio</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-400">Resultado de búsquedas</span>
                    </div>
                </li>
            </ol>
        </nav>

        <h1 class="text-3xl font-light text-gray-900 mb-8 border-b border-gray-200 pb-4">
            Resultado de búsquedas para "<span class="font-semibold">{{ $query }}</span>"
        </h1>

        @if($products->isEmpty())
            <div class="text-center py-20">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay resultados</h3>
                <p class="mt-1 text-sm text-gray-500">No encontramos productos que coincidan con tu búsqueda.</p>
                <div class="mt-6">
                    <a href="{{ route('tienda.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Volver al catálogo
                    </a>
                </div>
            </div>
        @else
            <!-- Controles y paginación top -->
            <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg mb-8 border border-gray-100">
                <div class="flex items-center space-x-2 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <div>
                    {{ $products->appends(['q' => $query])->links('pagination::tailwind') }}
                </div>
            </div>

            <!-- Cuadrícula de productos -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-y-10 gap-x-6">
                @foreach($products as $product)
                    <div class="group relative flex flex-col bg-white">
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-100 group-hover:opacity-75">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-gray-400 font-medium text-lg">
                                    Imagen no disponible
                                </div>
                            @endif
                            
                            <!-- Botones Hover -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black/20 gap-2">
                                <button onclick="openQuickView({{ $product->id }})" class="bg-white/90 backdrop-blur-sm text-gray-900 px-4 py-2 rounded-full font-medium text-sm shadow-lg hover:bg-indigo-600 hover:text-white transition-colors w-32">
                                    Vista rápida
                                </button>
                                <div class="flex gap-2">
                                    <button data-id-product="{{ $product->id }}" class="js-iqitwishlist-add bg-white/90 backdrop-blur-sm text-gray-900 w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:text-red-500 transition-colors" title="Lista de deseos">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </button>
                                    <button data-id-product="{{ $product->id }}" class="js-iqitcompare-add bg-white/90 backdrop-blur-sm text-gray-900 w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:text-indigo-600 transition-colors" title="Comparar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col items-center text-center flex-1">
                            <h3 class="text-sm text-gray-700 font-medium line-clamp-2">
                                <a href="{{ route('tienda.product', ['uuid' => $product->id]) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-base font-bold text-red-500">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación bottom -->
            <div class="mt-10 pt-6 border-t border-gray-200">
                {{ $products->appends(['q' => $query])->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
