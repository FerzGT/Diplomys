<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    //return redirect('/client/index');
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'form'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::group(['middleware'=>'auth'], function() {
        Route::get('index', [AdminController::class, 'index'])->name('index');
        Route::post('add_hall', [HallController::class, 'create'])->middleware('admin')->name('addHall');
        Route::post('add_movie', [AdminController::class, 'addMovie'])->name('addMovie');
        Route::post('del_hall/{id}', [HallController::class, 'delete'])->middleware('admin');
        Route::post('delete_movie/{id}', [AdminController::class, 'deleteMovie']);
    });
});

Route::prefix('client')->group(function () {
    Route::get('index', [ClientController::class, 'index']);
    Route::get('hall/{id}', [ClientController::class, 'hall']);
    Route::get('payment/{id}', [ClientController::class, 'payment']);
    Route::get('ticket/{id}', [ClientController::class, 'ticket']);
});