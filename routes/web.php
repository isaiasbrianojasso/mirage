<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DistributorController;

use Inertia\Inertia;


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('home');
});

// Legacy login redirects
Route::any('/iniciar-sesion', function () {
    return redirect()->route('login', request()->query());
});
Route::any('/tienda/iniciar-sesion', function () {
    return redirect()->route('login', request()->query());
});

// Social Login Routes
Route::get('/login/{provider}', [\App\Http\Controllers\Auth\SocialLoginController::class, 'redirect'])->name('social.login');
Route::get('/login/{provider}/callback', [\App\Http\Controllers\Auth\SocialLoginController::class, 'callback'])->name('social.callback');


// Catalog routes
Route::get('/catalogo/todo/', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalogo/todo/{category}', [App\Http\Controllers\CatalogController::class, 'category'])->name('catalog.category');
Route::get('/catalogo/todo/{category}/{subcategory}', [App\Http\Controllers\CatalogController::class, 'subcategory'])->name('catalog.subcategory');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Ruta dinámica según rol
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return app()->make(\App\Http\Controllers\Admin\DashboardController::class)->index();
        }
        return app()->make(\App\Http\Controllers\CustomerController::class)->dashboard();
    })->name('dashboard');
    
    Route::post('/notificaciones/marcar-leidas', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark_read');

    // Admin Routes
    Route::middleware(['is_admin'])->group(function () {
        Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
        Route::resource('admin/products', App\Http\Controllers\Admin\ProductController::class)->except(['show']);
        Route::resource('admin/banners', App\Http\Controllers\Admin\BannerController::class)->except(['show']);
        Route::resource('admin/orders', App\Http\Controllers\Admin\OrderController::class)->except(['destroy']);
        Route::post('admin/orders/{order}/payment', [App\Http\Controllers\Admin\OrderController::class, 'addPayment'])->name('orders.payment');
        Route::post('admin/orders/{order}/message', [App\Http\Controllers\Admin\OrderController::class, 'addMessage'])->name('orders.message');
        Route::post('admin/orders/{order}/refund', [App\Http\Controllers\Admin\OrderController::class, 'processRefund'])->name('orders.refund');
        Route::get('admin/orders/{order}/invoice', [App\Http\Controllers\Admin\OrderController::class, 'downloadInvoice'])->name('orders.invoice');
        Route::get('admin/api/customers/{customer}/addresses', [App\Http\Controllers\Admin\OrderController::class, 'getCustomerAddresses'])->name('api.customers.addresses');
        Route::get('admin/api/zones/{zone}/carriers', [App\Http\Controllers\Admin\OrderController::class, 'getCarriersForZone'])->name('api.zones.carriers');
        Route::resource('admin/customers', App\Http\Controllers\Admin\CustomerController::class)->except(['show']);
        Route::resource('admin/customer-groups', App\Http\Controllers\Admin\CustomerGroupController::class)->except(['show']);
        Route::resource('admin/zones', App\Http\Controllers\Admin\ZoneController::class)->except(['show']);
        Route::resource('admin/carriers', App\Http\Controllers\Admin\CarrierController::class)->except(['show']);
        Route::put('admin/carriers/{carrier}/toggle-active', [App\Http\Controllers\Admin\CarrierController::class, 'toggleActive'])->name('carriers.toggle-active');
        
        // Settings
        Route::get('/admin/company-settings', [\App\Http\Controllers\AdminCompanySettingController::class, 'edit'])->name('company-settings.edit');
        Route::post('/admin/company-settings', [\App\Http\Controllers\AdminCompanySettingController::class, 'update'])->name('company-settings.update');

        // Email Logs
        Route::get('/admin/email-logs', [\App\Http\Controllers\AdminEmailLogController::class, 'index'])->name('email-logs.index');

        // Email Templates
        Route::get('/admin/email-templates', [\App\Http\Controllers\AdminEmailTemplateController::class, 'index'])->name('admin.email-templates.index');
        Route::get('/admin/email-templates/{name}/edit', [\App\Http\Controllers\AdminEmailTemplateController::class, 'edit'])->name('admin.email-templates.edit');
        Route::put('/admin/email-templates/{name}', [\App\Http\Controllers\AdminEmailTemplateController::class, 'update'])->name('admin.email-templates.update');
    });

    // Customer Routes
    Route::get('/mis-pedidos', [\App\Http\Controllers\CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/mis-pedidos/{id}', [\App\Http\Controllers\CustomerController::class, 'orderShow'])->name('customer.orders.show');
    Route::get('/notificaciones', [\App\Http\Controllers\CustomerController::class, 'notifications'])->name('customer.notifications');
});

// Dynamic Routes for Tienda (MVC)
Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda.index');
    Route::post('/tienda/wishlist', [\App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/tienda/wishlist/{product_id}', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::get('/tienda/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');

    // Rutas para Comparar Productos
    Route::post('/tienda/compare', [\App\Http\Controllers\CompareController::class, 'add'])->name('compare.add');
    Route::delete('/tienda/compare/{product_id}', [\App\Http\Controllers\CompareController::class, 'remove'])->name('compare.remove');
    Route::get('/tienda/compare', [\App\Http\Controllers\CompareController::class, 'index'])->name('compare.index');
Route::get('/tienda/producto/quickview/{id}', [\App\Http\Controllers\QuickViewController::class, 'show'])->name('product.quickview');
Route::get('/tienda/comparar/data', [\App\Http\Controllers\QuickViewController::class, 'compare'])->name('product.compare');
Route::post('/tienda/producto/{slug}/review', [TiendaController::class, 'storeReview'])->middleware('throttle:5,1')->name('tienda.product.review');

Route::get('/tienda/categoria/{uuid}', [TiendaController::class, 'category'])->name('tienda.category');
Route::get('/tienda/producto/{uuid}', [TiendaController::class, 'product'])->name('tienda.product');
Route::get('/tienda/content/{slug}', function () {
    return view('tienda.content');
})->name('tienda.content');

Route::get('/tienda/contacto', function () {
    return view('tienda.contact');
})->name('tienda.contact');

// Search Routes
Route::get('/buscar/autocomplete', [\App\Http\Controllers\SearchController::class, 'autocomplete'])->name('search.autocomplete');
Route::get('/buscar', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.index');

// Shopping Cart Routes
Route::prefix('carrito')->name('cart.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::post('/agregar', [\App\Http\Controllers\CartController::class, 'add'])->name('add');
    Route::put('/actualizar/{id}', [\App\Http\Controllers\CartController::class, 'update'])->name('update');
    Route::delete('/eliminar/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('remove');
    Route::post('/vaciar', [\App\Http\Controllers\CartController::class, 'clear'])->name('clear');
});

// Checkout Routes
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
    Route::post('/shipping-rates', [\App\Http\Controllers\CheckoutController::class, 'calculateShipping'])->name('shipping-rates');
    Route::post('/procesar', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
    Route::get('/success/{reference}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('success');
    
    // Mercado Pago Callbacks
    Route::get('/mercadopago/success', [\App\Http\Controllers\CheckoutController::class, 'mercadopagoSuccess'])->name('mercadopago.success');
    Route::get('/mercadopago/failure', [\App\Http\Controllers\CheckoutController::class, 'mercadopagoFailure'])->name('mercadopago.failure');
    Route::get('/mercadopago/pending', [\App\Http\Controllers\CheckoutController::class, 'mercadopagoPending'])->name('mercadopago.pending');
});

// Dynamic Routes for Blog and Distributors
Route::get('/comunicacion/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/comunicacion/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/distribuidores', [DistributorController::class, 'index'])->name('distribuidores.index');

// Static legacy routes fallback
require __DIR__.'/web_mirage.php';

// Dynamic legacy fallback routes to prevent 404s on scraped pages and PrestaShop products
Route::get('/tienda/module/{path}', function ($path) {
    $cleanPath = preg_replace('/(\.html|\/index\.html)$/', '', $path);
    $viewName = 'tienda.module.' . str_replace('/', '.', $cleanPath);
    if (view()->exists($viewName)) {
        return view($viewName);
    }
    return redirect()->route('tienda.index');
})->where('path', '.*');

Route::get('/tienda/modules/{path}', function ($path) {
    $cleanPath = preg_replace('/(\.html|\/index\.html)$/', '', $path);
    $viewName = 'tienda.modules.' . str_replace('/', '.', $cleanPath);
    if (view()->exists($viewName)) {
        return view($viewName);
    }
    return redirect()->route('tienda.index');
})->where('path', '.*');

// Redirigir categorías antiguas .html a la categoría dinámica en base de datos
Route::get('/tienda/{slug}.html', function ($slug) {
    $cleanSlug = preg_replace('/^\d+-/', '', $slug);

    $category = \App\Models\Category::where('slug', $slug)
        ->orWhere('slug', $cleanSlug)
        ->first();

    if ($category) {
        return redirect()->route('tienda.category', ['uuid' => $category->uuid]);
    }

    $product = \App\Models\Product::where('slug', $slug)
        ->orWhere('slug', $cleanSlug)
        ->first();

    if ($product) {
        return redirect()->route('tienda.product', ['uuid' => $product->id]);
    }

    return redirect()->route('tienda.index');
});

// Redirigir categorías antiguas con /index.html a la categoría dinámica en base de datos
Route::get('/tienda/{slug}/index.html', function ($slug) {
    $cleanSlug = preg_replace('/^\d+-/', '', $slug);

    $category = \App\Models\Category::where('slug', $slug)
        ->orWhere('slug', $cleanSlug)
        ->first();

    if ($category) {
        return redirect()->route('tienda.category', ['uuid' => $category->uuid]);
    }

    return redirect()->route('tienda.index');
});

// Legacy PrestaShop product routes (e.g., /tienda/refacciones/616-motor-condensador-1-ton-ykt-32-6-202l.html)
/*
Route::get('/tienda/{category}/{slug}.html', function ($category, $slug) {
    $cleanSlug = preg_replace('/^\d+-/', '', $slug);

    // Check if the product exists in the DB (original or clean slug)
    $product = \App\Models\Product::where('slug', $slug)
        ->orWhere('slug', $cleanSlug)
        ->first();

    if ($product) {
        return redirect()->route('tienda.product', ['uuid' => $product->id]);
    }

    // If product doesn't exist, redirect to parent category (clean or original) in DB
    $cleanCategory = preg_replace('/^\d+-/', '', $category);
    $dbCategory = \App\Models\Category::where('slug', $category)
        ->orWhere('slug', $cleanCategory)
        ->first();

    if ($dbCategory) {
        return redirect()->route('tienda.category', ['uuid' => $dbCategory->uuid]);
    }

    return redirect()->route('tienda.index');
});
*/
Route::get('/test-cart', function() { dd(session()->get('cart')); });
Route::post('/module/iqitcompare/actions', [\App\Http\Controllers\CompareController::class, 'actions'])->name('compare.actions');
