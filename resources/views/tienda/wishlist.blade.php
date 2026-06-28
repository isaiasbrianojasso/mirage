@extends('layouts.tienda')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Mi Lista de Deseos</h1>

    @if(!isset($wishlistItems) || $wishlistItems->count() == 0)
        <div class="alert alert-info">
            No tienes productos en tu lista de deseos.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="thead-light">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wishlistItems as $item)
                        <tr>
                            <td style="width: 150px;">
                                @if($item->product->images && $item->product->images->count() > 0)
                                    <img src="{{ $item->product->images->first()->image_url }}" alt="{{ $item->product->name }}" class="img-fluid" style="max-height: 100px;">
                                @else
                                    <img src="/tienda_assets/img/p/mx-default-home_default.jpg" alt="Default" class="img-fluid" style="max-height: 100px;">
                                @endif
                            </td>
                            <td>
                                <h5><a href="{{ route('tienda.product', $item->product->id) }}">{{ $item->product->name }}</a></h5>
                            </td>
                            <td>
                                @if($item->product->discount_price)
                                    <span class="text-danger font-weight-bold h5">${{ number_format($item->product->discount_price, 2) }}</span>
                                    <br>
                                    <span class="text-muted" style="text-decoration: line-through;">${{ number_format($item->product->price, 2) }}</span>
                                @else
                                    <span class="font-weight-bold h5">${{ number_format($item->product->price, 2) }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm mb-2">
                                        <i class="fa fa-shopping-cart"></i> Agregar al carrito
                                    </button>
                                </form>
                                <br>
                                <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar de la lista de deseos">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection