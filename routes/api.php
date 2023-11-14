<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\MissiosnController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('create-client', [ClientsController::class, 'createClient']);
Route::post('login', [ClientsController::class, 'login']);
Route::post('updateClient/{id}', [ClientsController::class, 'updateClient']);
Route::post('loginM', [ManagersController::class, 'login']);
Route::get('getCategorie', [CategoriesController::class, 'fetchCategories']);
Route::get('/categories/{category}/missions', [MissiosnController::class, 'getMissionsByCategory']);



