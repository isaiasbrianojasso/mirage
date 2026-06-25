@extends('layouts.store')

@section('title', 'Tienda Mirage | Todo el Catálogo')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
                Catálogo de Productos
            </h1>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                Explora nuestras categorías y encuentra el equipo ideal para tus necesidades.
            </p>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            @foreach($categories as $category)
                <a href="{{ route('tienda.category', $category->slug) }}" class="group relative block overflow-hidden rounded-2xl bg-white shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                        @if($category->image_url)
                            <img src="{{ Storage::url($category->image_url) }}" alt="{{ $category->name }}" class="h-64 w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="h-64 w-full flex items-center justify-center bg-gray-100 text-gray-400">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $category->name }}</h3>
                        @if($category->description)
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $category->description }}</p>
                        @endif
                        <span class="mt-4 inline-block text-indigo-600 font-semibold group-hover:text-indigo-800 transition-colors">Ver productos &rarr;</span>
                    </div>
                </a>
            @endforeach

            @if($categories->isEmpty())
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Próximamente tendremos nuevas categorías disponibles.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
