<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\ColorController;
use App\Http\Controllers\api\SizeController;
use App\Http\Controllers\api\PriceController;
use App\Http\Controllers\api\ImageController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\OrderDetailController;
use App\Http\Controllers\api\ImportController;
use App\Http\Controllers\api\ImportDetailController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\FileController;
use App\Http\Controllers\api\ShoppingController;
use App\Http\Controllers\api\DashboardController;

Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('color', ColorController::class);
Route::resource('size', SizeController::class);
Route::resource('price', PriceController::class);
Route::resource('image', ImageController::class);
Route::resource('order', OrderController::class);
Route::resource('order-detail', OrderDetailController::class);
Route::resource('import', ImportController::class);
Route::resource('import-detail', ImportDetailController::class);
Route::resource('user', UserController::class);
Route::resource('file', FileController::class);

//routing for shopping
Route::get('/shopping/products',[ShoppingController::class, 'getProducts']);
Route::get('/shopping/get-sales/{n}',[ShoppingController::class, 'getSales']);
Route::get('/shopping/get-trending/{cate_id}/{n}',[ShoppingController::class, 'getHot']);
Route::get('/shopping/get-new/{n}',[ShoppingController::class, 'getNew']);
Route::get('/shopping/get-product/{product_id}',[ShoppingController::class, 'getProduct']);
Route::get('/shopping/get-categories',[ShoppingController::class, 'getCategories']);
Route::get('/shopping/get-colors/{id}',[ShoppingController::class, 'getColors']);
Route::get('/shopping/get-sizes/{id}',[ShoppingController::class, 'getSizes']);
Route::get('/shopping/get-images/{id}',[ShoppingController::class, 'getImages']);
Route::get('/shopping/get-price/{id}',[ShoppingController::class, 'getPrice']);
Route::post('/shopping/create-user',[ShoppingController::class, 'createUser']);

Route::get('/dashboard/get-year-profit/{n}',[DashBoardController::class, 'getYearProfit']);
Route::get('/dashboard/get-month-profit/{year}',[DashBoardController::class, 'getMonhtProfit']);
Route::get('/dashboard/get-loyal-customer/{n}',[DashBoardController::class, 'getLoyalCustomer']);

