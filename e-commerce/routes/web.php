<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/redirect',[HomeController::class,'redirect']);


Route::get('/view_category',[AdminController::class,'view_category']);
Route::post('/add_category',[AdminController::class,'add_category']);
Route::get('/delete_category/{id}',[AdminController::class,'delete_category']);


Route::get('/view_product',[AdminController::class,'view_product']);
Route::post('/add_product',[AdminController::class,'add_product']);
Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
Route::get('/update_product/{id}',[AdminController::class,'update_product']);
Route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);
Route::get('/view_user',[AdminController::class,'view_user']);
Route::get('/update_user/{id}',[AdminController::class,'update_user']);
Route::post('/update_user_confirm/{id}',[AdminController::class,'update_user_confirm']);


Route::get('/delete_user/{id}',[AdminController::class,'delete_user']);

Route::get('/add_stock/{id}',[AdminController::class,'add_stock']);
Route::post('/add_stock_confirm/{id}',[AdminController::class,'add_stock_confirm']);


Route::get('/product_details/{id}',[HomeController::class,'product_details']);
Route::get('/productDetails/{id}',[HomeController::class,'productDetails']);
Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
Route::get('/show_cart',[HomeController::class,'show_cart']);
Route::get('/OrderHistory',[HomeController::class,'OrderHistory']);
Route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
Route::get('/update_cart/{id}{product_id}',[HomeController::class,'update_cart']);
Route::get('/checkout',[HomeController::class,'checkout']);
Route::post('/add_order/{id}',[HomeController::class,'add_order']);
Route::get('/order_infoU/{id}',[HomeController::class,'order_info']);

Route::get('/update_order_status/{id}',[AdminController::class,'update_order_status']);
Route::post('/update_order_confirm/{id}',[AdminController::class,'update_order_confirm']);
Route::get('/order_info/{id}',[AdminController::class,'order_info']);












require __DIR__.'/auth.php';
