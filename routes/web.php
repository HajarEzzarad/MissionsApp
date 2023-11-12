<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    //****Managers CRUD*/
    Route::resource('managers', \App\Http\Controllers\ManagersController::class);
    /***categories CRUD */
    Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
    //*****Missions 
    Route::get('categories/{category}/missions/create',[\App\Http\Controllers\MissiosnController::class,'create'])->name('create-mission');
    Route::POST('categories/{category}/missions',[\App\Http\Controllers\MissiosnController::class,'store'])->name('store-mission');
    Route::get('/missions-show/{mission}', [\App\Http\Controllers\MissiosnController::class,'show'])->name('missions-show');
    Route::get('/missions-edit/{id}', [\App\Http\Controllers\MissiosnController::class,'edit'])->name('missions.edit');
    Route::PUT('/missions-update/{mission}', [\App\Http\Controllers\MissiosnController::class,'update'])->name('missions.update');
    Route::delete('/missions/{mission}', [\App\Http\Controllers\MissiosnController::class,'destroy'])->name('missions-destroy');
    //*********clients
    //CRUD clients
    Route::resource('users', \App\Http\Controllers\ClientsController::class);
    //showing unpproved clients
    Route::get('unapproved-clients',[App\Http\Controllers\ClientsController::class,'ShowUnapprovedClients'])->name('unapproved-clients');
    //accept the clients pending
    Route::get('/accept-client/{id}',[App\Http\Controllers\ClientsController::class,'acceptClient'])->name('accept-client');
});
