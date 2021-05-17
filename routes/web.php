<?php

use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\DashboarsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//dashboard
Route::get('dashboard', [DashboarsController::class, 'index'] );

//categories
Route::get('create-category', [CategoryController::class, 'create'] );

Route::post('post-category-form', [CategoryController::class, 'store'] );

Route::get('view-all-category', [CategoryController::class, 'index'] );

Route::get('edit-category/{id}', [CategoryController::class, 'edit']);

Route::post('update-category/{id}', [CategoryController::class, 'update']);

Route::get('delete-category/{id}', [CategoryController::class, 'destroy']);

//products
Route::get('get-product-form', [ProductController::class, 'create']);

Route::post('post-product-form', [ProductController::class, 'store']);

Route::get('view-all-products', [ProductController::class, 'index'] );

Route::get('edit-product/{id}', [ProductController::class, 'edit'] );

Route::post('post-product-edit-form/{id}', [ProductController::class, 'update']);

Route::get('delete-product/{id}', [ProductController::class, 'destroy'] );

//sliders
Route::get('get-slider-form',[SliderController::class, 'create']);

Route::post('post-slider-form',[SliderController::class, 'store']);
