<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LogController;
use App\Http\COntrollers\LogItemController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

//控制器路由
Route::middleware(['auth'])->group(function(){
    Route::resource('Site',SiteController::class);
    Route::resource('log',LogController::class);

    Route::get('/logitem/{id}',[LogItemController::class,'show'])->name('logitem.show');;
    Route::get('/logitem/create/{id}',[LogItemController::class,'create'])->name('logitem.create');
    Route::post('/logitem/store', [LogItemController::class, 'store'])->name('logitem.store');
    Route::get('logitem/edit/{logitem}',[LogItemController::class,'edit'])->name('logitem.edit');
    Route::put('logitem/update/{logitem}',[LogItemController::class,'update'])->name('logitem.update');
    Route::delete('logitem/destroy/{logitem}',[LogItemController::class,'destroy'])->name('logitem.destroy');
});


//API路由
Route::get('/api/Map',[Controller::class,'Map']);
Route::get('/api/MapEF',[Controller::class,'MapEF']);
Route::get('/api/GetLog',[Controller::class,'GetLog']);
Route::get('/api/GetLogItem/{id}',[Controller::class,'GetLogItem']);
Route::post('/api/SaveEF',[Controller::class,'SaveEF']);
Route::put('api/EditEF/{id}',[Controller::class,'EditEF']);


//頁面路由
Route::get('/Map',[ViewController::class,'Map']);
Route::get('/LogT',[ViewController::class,'Log']);
Route::get('/LogShow',[ViewController::class,'LogShow']);
Route::get('About',[ViewController::class,'About']);

//登入驗證
Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');