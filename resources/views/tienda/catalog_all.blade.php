@extends('layouts.tienda')

@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 font-weight-bold text-uppercase" style="color: #1f2937;">Nuestro Catálogo</h1>
            <p class="lead text-muted">Explora todas nuestras categorías y encuentra el producto ideal para ti.</p>
        </div>
    </div>

    <div class="row mt-4">
        @if(isset($rootCategories) && $rootCategories->count() > 0)
            @foreach($rootCategories as $category)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 category-card" style="transition: transform 0.3s; border-radius: 12px; overflow: hidden;">
                        <img src="{{ $category->representative_image }}" class="card-img-top" alt="{{ $category->name }}" onerror="this.src='/tienda_assets/img/p/mx-default-home_default.jpg'" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <h3 class="card-title font-weight-bold mb-3" style="color: #e62228;">{{ $category->name }}</h3>
                            <p class="text-muted mb-4">{{ $category->products_count ?? 0 }} Productos disponibles</p>
                            <a href="{{ route('tienda.category', ['uuid' => $category->uuid]) }}" class="btn btn-outline-danger btn-lg mt-auto mx-auto" style="border-radius: 30px; padding: 10px 30px; font-weight: 600;">
                                Ver Productos <i class="fa fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <div class="alert alert-info" style="border-radius: 10px;">
                    <i class="fa fa-info-circle mr-2"></i> No hay categorías disponibles en este momento.
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection
