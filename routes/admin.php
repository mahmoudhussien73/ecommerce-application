<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;


Route::group(['prefix'  =>  'admin','as' => 'admin.'], function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login'])->name('login.post');


    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('logout', [LoginController::class,'logout'])->name('logout');
        Route::get('/settings', [SettingController::class,'index'])->name('settings');
        Route::post('/settings', [SettingController::class,'update'])->name('settings.update');
        Route::resource('categories',CategoryController::class);
        Route::resource('attributes',AttributeController::class);

        Route::post('/get-values', [AttributeValueController::class,'getValues']);
        Route::post('/add-values', [AttributeValueController::class,'addValues']);
        Route::post('/update-values', [AttributeValueController::class,'updateValues']);
        Route::post('/delete-values', [AttributeValueController::class,'deleteValues']);

        Route::get('/', function () {
            return view('admin.index');
        })->name('dashboard');

    });


});
