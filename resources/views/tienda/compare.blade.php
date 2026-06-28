@extends('layouts.tienda')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Comparar Productos</h1>

    @if(!isset($products) || count($products) == 0)
        <div class="alert alert-info">
            No tienes productos en tu lista de comparación.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 200px;">Características</th>
                        @foreach($products as $product)
                            <th>
                                <h5>{{ $product->name }}</h5>
                                @if($product->images && $product->images->count() > 0)
                                    <img src="{{ $product->images->first()->image_url }}" alt="{{ $product->name }}" class="img-fluid my-2" style="max-height: 150px;">
                                @else
                                    <img src="/tienda_assets/img/p/mx-default-home_default.jpg" alt="Default" class="img-fluid my-2" style="max-height: 150px;">
                                @endif
                                
                                <div class="mt-2">
                                    @if($product->discount_price)
                                        <span class="text-danger font-weight-bold h5">${{ number_format($product->discount_price, 2) }}</span>
                                        <span class="text-muted" style="text-decoration: line-through;">${{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="font-weight-bold h5">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>

                                <div class="mt-3">
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-shopping-cart"></i> Agregar
                                        </button>
                                    </form>
                                    <form action="{{ route('compare.remove', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar de la comparación">
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
                        <td class="font-weight-bold text-left align-middle">Descripción</td>
                        @foreach($products as $product)
                            <td>{{ strip_tags($product->short_description) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="font-weight-bold text-left align-middle">Especificaciones</td>
                        @foreach($products as $product)
                            <td class="text-left">
                                @if(is_array($product->specifications))
                                    <ul class="mb-0 pl-3">
                                        @foreach($product->specifications as $spec)
                                            <li>{{ $spec }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    N/A
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection