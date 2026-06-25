<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/tienda/11-aire-acondicionado', 'GET');
$kernelHttp = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernelHttp->handle($request);
echo "STATUS: " . $response->getStatusCode() . "\n";
if ($response->exception) {
    echo "EXCEPTION: " . $response->exception->getMessage() . " at " . $response->exception->getFile() . ":" . $response->exception->getLine() . "\n";
} else {
    echo substr($response->getContent(), 0, 500);
}
