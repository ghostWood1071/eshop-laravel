<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin')->middleware('auth-admin');

Route::get('/admin/category', function () {
    return view('admin.category');
})->name('category')->middleware('auth-staff');

Route::get('/admin/product', function () {
    return view('admin.product');
})->name('product')->middleware('auth-staff');

Route::get('/admin/order', function () {
    return view('admin.order');
})->name('order')->middleware('auth-staff');

Route::get('/admin/import', function () {
    return view('admin.import');
})->name('import')->middleware('auth-staff');

Route::get('/admin/user', function () {
    return view('admin.user');
})->name('user')->middleware('auth-admin');

//shopping
Route::get('/', function () {
    return view('shop.index');
});

Route::get('/product',function(){
    return view('shop.product', ['header'=>true]);
});

Route::get('/product-detail',function(){
    return view('shop.product-detail', ['header'=>true]);
});

Route::get('/cart',function(){
    return view('shop.cart', ['header'=>true]);
});

Route::get('/checkout',function(){
    return view('shop.checkout', ['header'=>true]);
})->middleware('auth-customer');


Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/authenthicate/auth', [AuthController::class, 'authenthicate']);
Route::post('/authenthicate/login', [AuthController::class, 'login']);
Route::get('/auththenthicate/redirect', [AuthController::class, 'redirect']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/username', [AuthController::class, 'getUserName']);

Route::get('/signin',function(){
    return view('shop.signin');
});

Route::get('/your-orders', function(){
    return view('shop.order', ['header'=>true]);
});