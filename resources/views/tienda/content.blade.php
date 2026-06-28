@extends('layouts.tienda')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5 text-center">
            <h1 class="mb-4">Contenido</h1>
            <p class="text-muted">
                Esta página está en construcción o el contenido ha sido movido.
            </p>
            <a href="{{ route('tienda.index') }}" class="btn btn-primary mt-3">
                <i class="fa fa-home"></i> Volver al Inicio
            </a>
        </div>
    </div>
</div>
@endsection