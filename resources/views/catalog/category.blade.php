@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-12">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ ucfirst($category) }}
                </h1>
                <a href="{{ url('catalogo/todo/') }}" class="text-blue-600 hover:text-blue-800">
                    ← Volver al catálogo
                </a>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Subcategorías de ejemplo para aire acondicionado -->
                @if($category === 'aire-acondicionado')
                    <div class="overflow-hidden transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
                        <a href="{{ url('catalogo/todo/aire-acondicionado/minisplit') }}" class="block">
                            <div class="flex items-center justify-center h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M8 20h8"></path>
                                </svg>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900">Mini Split</h3>
                                <p class="mt-2 text-sm text-gray-500">On/Off e Inverter</p>
                            </div>
                        </a>
                    </div>

                    <div class="overflow-hidden transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
                        <a href="{{ url('catalogo/todo/aire-acondicionado/comercial') }}" class="block">
                            <div class="flex items-center justify-center h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                </svg>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900">Comercial</h3>
                                <p class="mt-2 text-sm text-gray-500">Para oficinas y negocios</p>
                            </div>
                        </a>
                    </div>

                    <div class="overflow-hidden transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
                        <a href="{{ url('catalogo/todo/aire-acondicionado/portatiles') }}" class="block">
                            <div class="flex items-center justify-center h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900">Portátiles</h3>
                                <p class="mt-2 text-sm text-gray-500">Unidades móviles de aire</p>
                            </div>
                        </a>
                    </div>
                @elseif($category === 'linea-blanca')
                    <div class="overflow-hidden transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
                        <a href="{{ url('catalogo/todo/linea-blanca/lavadoras-y-secadoras') }}" class="block">
                            <div class="flex items-center justify-center h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                </svg>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900">Lavadoras y Secadoras</h3>
                                <p class="mt-2 text-sm text-gray-500">Para tu hogar</p>
                            </div>
                        </a>
                    </div>

                    <div class="overflow-hidden transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
                        <a href="{{ url('catalogo/todo/linea-blanca/refrigeradores') }}" class="block">
                            <div class="flex items-center justify-center h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                </svg>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900">Refrigeradores</h3>
                                <p class="mt-2 text-sm text-gray-500">Mantén tus alimentos frescos</p>
                            </div>
                        </a>
                    </div>

                    <div class="overflow-hidden transition-shadow bg-white rounded-lg shadow hover:shadow-lg">
                        <a href="{{ url('catalogo/todo/linea-blanca/estufas') }}" class="block">
                            <div class="flex items-center justify-center h-48 bg-gray-100">
                                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                </svg>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-gray-900">Estufas</h3>
                                <p class="mt-2 text-sm text-gray-500">Para cocinar tus alimentos</p>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="col-span-3">
                        <p class="text-gray-500">Subcategorías para {{ ucfirst($category) }} pronto disponibles.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
