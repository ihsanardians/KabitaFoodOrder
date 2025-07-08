<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\MenuController as CustomerMenuController;
use App\Http\Controllers\Customer\CartController as CustomerCartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Halaman utama langsung redirect ke menu
Route::get('/', function () {
    return redirect()->route('customer.menu.index');
});

// --- RUTE UNTUK CUSTOMER ---
Route::group(['as' => 'customer.'], function () {
    // Menu
    Route::get('/menu', [CustomerMenuController::class, 'index'])->name('menu.index');

    // Cart
    Route::get('/cart', [CustomerCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CustomerCartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CustomerCartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{product}', [CustomerCartController::class, 'remove'])->name('cart.remove');

    // Order
Route::post('/order', [CustomerOrderController::class, 'store'])->name('order.store');
Route::get('/order/success/{order}', [CustomerOrderController::class, 'success'])->name('order.success');
Route::get('/invoice/{id}', [CustomerOrderController::class, 'invoice'])->name('order.invoice');


});

// Laravel Auth routes
Auth::routes(['register' => false]);

// --- RUTE UNTUK KASIR/ADMIN ---
Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Menu
    Route::resource('products', AdminProductController::class);

    // CRUD User (Kasir)
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Kelola Order
    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Rekap Penjualan
    Route::get('sales-recap', [AdminOrderController::class, 'recap'])->name('sales.recap');

    //delete
    Route::delete('admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    //edit menu
    // Untuk menampilkan form edit
    Route::get('admin/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');

    // Untuk menyimpan perubahan
    Route::put('admin/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');

    





});