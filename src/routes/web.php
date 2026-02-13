<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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


Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');           // 一覧
    Route::get('/register', [ProductController::class, 'create'])->name('create'); // 登録画面
    Route::post('/register', [ProductController::class, 'store'])->name('store');   // 登録処理
    Route::patch('/{id}', [ProductController::class, 'update'])->name('update'); // 更新
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy'); // 削除
    Route::get('/{Id}', [ProductController::class, 'show'])->name('show');   // 詳細
});