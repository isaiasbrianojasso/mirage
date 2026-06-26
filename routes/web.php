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
            return redirect()->route('orders.index');
        }
        return redirect()->route('customer.orders');
    })->name('dashboard');

    // Admin Routes
    Route::middleware(['is_admin'])->group(function () {
        Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
        Route::resource('admin/products', App\Http\Controllers\Admin\ProductController::class)->except(['show']);
        Route::resource('admin/banners', App\Http\Controllers\Admin\BannerController::class)->except(['show']);
        Route::resource('admin/orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
        Route::get('admin/settings', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::post('admin/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
    
    // Customer Routes
    Route::get('/mis-pedidos', [\App\Http\Controllers\CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/mis-pedidos/{id}', [\App\Http\Controllers\CustomerController::class, 'orderShow'])->name('customer.orders.show');
});

// Dynamic Routes for Tienda (MVC)
Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda.index');
Route::post('/tienda/wishlist', [\App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/tienda/wishlist/{product_id}', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/tienda/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/tienda/producto/quickview/{id}', [\App\Http\Controllers\QuickViewController::class, 'show'])->name('product.quickview');
Route::get('/tienda/comparar/data', [\App\Http\Controllers\QuickViewController::class, 'compare'])->name('product.compare');
Route::post('/tienda/producto/{slug}/review', [TiendaController::class, 'storeReview'])->name('tienda.product.review');

Route::get('/tienda/{slug}', [TiendaController::class, 'category'])->name('tienda.category');
Route::get('/tienda/producto/{slug}', [TiendaController::class, 'product'])->name('tienda.product');

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
    Route::post('/procesar', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('store');
});

// Dynamic Routes for Blog and Distributors
Route::get('/comunicacion/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/comunicacion/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/distribuidores', [DistributorController::class, 'index'])->name('distribuidores.index');

// Static legacy routes fallback
require __DIR__.'/web_mirage.php';
// require __DIR__.'/web_tienda.php'; // COMMENTED OUT FOR TESTING
