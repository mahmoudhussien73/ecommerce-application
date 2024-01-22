<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ProductAttributeController;

Route::group(['prefix'  =>  'admin','as' => 'admin.'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login'])->name('login.post');


    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('logout', [LoginController::class,'logout'])->name('logout');
        Route::get('/settings', [SettingController::class,'index'])->name('settings');
        Route::post('/settings', [SettingController::class,'update'])->name('settings.update');
        Route::resource('categories',CategoryController::class);
        Route::resource('brands',BrandController::class);

        Route::resource('products',ProductController::class);
        Route::group(['prefix' => 'products'], function () {
            Route::post('images/upload', [ProductImageController::class,'upload'])->name('products.images.upload');
            Route::get('images/{id}/delete', [ProductImageController::class,'delete'])->name('products.images.delete');
            // Load attributes on the page load
            Route::get('attributes/load', [ProductAttributeController::class,'loadAttributes']);
            // Load product attributes on the page load
            Route::post('attributes', [ProductAttributeController::class,'productAttributes']);
            // Load option values for a attribute
            Route::post('attributes/values', [ProductAttributeController::class,'loadValues']);
            // Add product attribute to the current product
            Route::post('attributes/add', [ProductAttributeController::class,'addAttribute']);
            // Delete product attribute from the current product
            Route::post('attributes/delete', [ProductAttributeController::class,'deleteAttribute']);
        });


        Route::group(['prefix' => 'attributes'],function(){
            Route::resource('attributes',AttributeController::class);
            Route::post('/get-values', [AttributeValueController::class,'getValues'])->name('getValues');
            Route::post('/add-values', [AttributeValueController::class,'addValues'])->name('addValues');
            Route::post('/update-values', [AttributeValueController::class,'updateValues'])->name('updateValues');
            Route::post('/delete-values', [AttributeValueController::class,'deleteValues'])->name('deleteValues');
        });

        Route::get('/', function () {
            return view('admin.index');
        })->name('dashboard');

    });


});
