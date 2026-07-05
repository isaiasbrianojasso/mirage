<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$mpToken = \App\Models\CompanySetting::get('mercadopago_access_token');
$response = \Illuminate\Support\Facades\Http::withToken($mpToken)->post('https://api.mercadopago.com/checkout/preferences', [
    'items' => [['title' => 'Test', 'quantity' => 1, 'currency_id' => 'MXN', 'unit_price' => 10]],
    'back_urls' => ['success' => 'http://127.0.0.1:8000/checkout/mercadopago/success', 'failure' => 'http://127.0.0.1:8000/checkout/mercadopago/failure', 'pending' => 'http://127.0.0.1:8000/checkout/mercadopago/pending'],
    'auto_return' => 'approved'
]);
echo json_encode(['status' => $response->status(), 'body' => $response->json()]);
