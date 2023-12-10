<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::get('/getproducts', [ProductController::class, 'get_products']);
Route::post('/addproduct', [ProductController::class, 'add_product']);
Route::delete('/deleteproduct/{product_id}', [ProductController::class, 'delete_product']);
Route::patch('/updateproduct/{product_id}', [ProductController::class, 'update_product']);

Route::get('/getshoppingcart',[ShoppingCartController::class,'get_shopping_cart']);
Route::post('/addtoshoppingcart',[ShoppingCartController::class,'add_shopping_cart']);

