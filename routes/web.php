<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QnaController;
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

Route::get('/crud', [CrudsController::class, 'index'])->name('crud.index');
Route::get('/show/{id}', [CrudsController::class, 'show'])->name('crud.show');
Route::get('/edit/{id}', [CrudsController::class, 'edit'])->name('crud.edit');
Route::delete('/destroy/{id}', [CrudsController::class, 'destroy'])->name('crud.destroy');
Route::post('/store', [CrudsController::class, 'store'])->name('crud.store');
Route::post('/update/{id}', [CrudsController::class, 'update'])->name('crud.update');
Route::get('/create', [CrudsController::class, 'create']);
//Route::get('/crud', 'App\Http\Controllers\CrudsController@index');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/qna', [QnaController::class, 'index'])->name('qna.index');