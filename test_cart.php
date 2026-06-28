<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::create(
        '/carrito/agregar',
        'POST',
        ['product_id' => '019f0ca8-4378-73b2-880d-3fbfcd66f4b5', 'quantity' => 1, '_token' => csrf_token()]
    )
);
// Actually it's hard to test session without a real browser
