<?php

use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetalProductController;
use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Controllers\MenuProductController;
use Illuminate\Support\Facades\Route;

Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function (){
    Route::prefix('admin')->group(function (){
        Route::get('', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function(){
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'edit']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::delete('destroy', [MenuController::class, 'destroy']);
        });


        #Product
        Route::prefix('product')->group(function(){
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('list', [ProductController::class, 'show']);
            Route::get('edit/{product}', [ProductController::class, 'edit']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::delete('destroy', [ProductController::class, 'destroy']);
        });

        #Slider
        Route::prefix('slider')->group(function(){
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{sliderProduct}', [SliderController::class, 'edit']);
            Route::post('edit/{sliderProduct}', [SliderController::class, 'update']);
            Route::delete('destroy', [SliderController::class, 'destroy']);
        });

        #upload
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});

Route::get('/', [\App\Http\Controllers\MainController::class, 'index']);
Route::post('/services/load-product', [\App\Http\Controllers\MainController::class, 'loadMore']);
// Route::post('/services/detal-product', [\App\Http\Controllers\MainController::class, 'detalProduct']);

Route::get('/danh-muc/{id}-{slug}', [MenuProductController::class, 'index']);
Route::get('/san-pham/{id}-{slug}', [DetalProductController::class, 'index']);
Route::post('/add-cart', [CartController::class, 'index']);

Route::get('/carts', [CartController::class, 'show']);