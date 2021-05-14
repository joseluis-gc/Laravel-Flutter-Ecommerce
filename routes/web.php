<?php

use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\DashboarsController;
use App\Http\Controllers\CategoryController;
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

Route::get('dashboard', [DashboarsController::class, 'index'] );

Route::get('create-category', [CategoryController::class, 'create'] );

Route::post('post-category-form', [CategoryController::class, 'store'] );

Route::get('view-all-category', [CategoryController::class, 'index'] );

Route::get('edit-category/{id}', [CategoryController::class, 'edit']);

Route::post('update-category/{id}', [CategoryController::class, 'update']);

Route::get('delete-category/{id}', [CategoryController::class, 'destroy']);
