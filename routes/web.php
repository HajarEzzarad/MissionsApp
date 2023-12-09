<?php

use App\Models\Manager;
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
    // page home dashboard.2
    Route::get('/dashboard',[App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    //****Managers CRUD*/
    Route::resource('managers', \App\Http\Controllers\ManagersController::class);
    /***categories CRUD */
    Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
    //add managers to a category and delete it
    Route::get('/categories/{category}/datach-manager/{manager}', [\App\Http\Controllers\CategoriesController::class, 'detachManager'])->name('categories.detachManager');
    Route::get('/categories/{category}/add-manager/{manager}', [\App\Http\Controllers\CategoriesController::class, 'addManager'])->name('categories.addManager');
    //*****Missions 
    Route::get('categories/{category}/missions/create',[\App\Http\Controllers\MissiosnController::class,'create'])->name('create-mission');
    Route::POST('categories/{category}/missions',[\App\Http\Controllers\MissiosnController::class,'store'])->name('store-mission');
    Route::get('/missions-show/{mission}', [\App\Http\Controllers\MissiosnController::class,'show'])->name('missions-show');
    Route::get('/missions-edit/{id}', [\App\Http\Controllers\MissiosnController::class,'edit'])->name('missions.edit');
    Route::put('/missions/{id}', [\App\Http\Controllers\MissiosnController::class,'update'])->name('missions.update');
    Route::delete('/missions/{mission}', [\App\Http\Controllers\MissiosnController::class,'destroy'])->name('missions-destroy');
    //*********clients
    //CRUD clients
    Route::resource('users', \App\Http\Controllers\ClientsController::class);
    //showing unpproved clients
    Route::get('unapproved-clients',[App\Http\Controllers\ClientsController::class,'ShowUnapprovedClients'])->name('users.unapproved-clients');
    //accept the clients pending
    Route::get('/accept-client/{id}',[App\Http\Controllers\ClientsController::class,'acceptClient'])->name('users.accept-client');
    Route::get('/missions-completed/{userId}',[App\Http\Controllers\ClientsController::class,'toMissionsCompleted'])->name('users.missions-completed');
    Route::post('/valide-missions-completed/{userId}/{missionId}',[App\Http\Controllers\ClientsController::class,'validateMissionsCompleted'])->name('valide-missions-completed');
    Route::get('/payement/{userId}',[App\Http\Controllers\ClientsController::class,'toPayement'])->name('users.payement-user');
    Route::post('/ajouter-payer/{userId}',[App\Http\Controllers\ClientsController::class,'ajouterPayer'])->name('users.ajouter-payer');


    
    //**Chats */

    Route::get('/chats', [\App\Http\Controllers\ChatController::class, 'index'])->name('chats.index');
    Route::get('/get-chatted-users',  [\App\Http\Controllers\ChatController::class, 'getChattedUsers'])->name('get-chatted-users');



});



