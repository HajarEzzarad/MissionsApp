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
Route::get('/categories/for-manager/{managerId}', [CategoriesController::class, 'categoriesForManager']);
Route::post('/delete/{id}', [CategoriesController::class, 'deleteC']);
Route::post('categories/add', [CategoriesController::class, 'addCategoryByManager']);
Route::post('categories/update/{id}', [CategoriesController::class, 'updateCategory']);
Route::post('missions/{id}', [MissiosnController::class, 'deleteMission']);
Route::post('categories/{categoryId}/missions', [MissiosnController::class,'createMissionAPI']);
Route::post('update/missions/{missionId}', [MissiosnController::class,'updateMission']);
Route::get('/clients', [ClientsController::class, 'getClients']);
Route::get('/managers', [ManagersController::class, 'getManagers']);
Route::post('/getUserDetails', [ManagersController::class, 'getUserDetails']);
Route::put('/missioncomplete/{clientId}', [ClientsController::class,'updateMissionComplete']);
Route::get('/mission-history/{missionIds}',[ MissiosnController::class,'getMissionHistory']);
Route::put('/update-mission-status', [ClientsController::class, 'updateMissionStatus']);
Route::get('/category/{categoryId}/manager', [CategoriesController::class, 'getManager']);
Route::get('/clients/by-mission/{missionId}', [ClientsController::class, 'getClientsByMission']);
Route::post('addPayer/{Id}', [ClientsController::class, 'AddPayer']);
Route::get('getClientInfo/{Id}', [ClientsController::class, 'getClientInfo']);
Route::post('updateClientInfo/{id}', [ClientsController::class, 'updateClientInfo']);
Route::get('/user-mission-statistics/{clientId}', [ClientsController::class, 'getUserMissionStatistics']);
Route::get('/client/{clientId}/payer-statistics', [ClientsController::class, 'getClientPayerStatistics']);
Route::get('/getCategoryManagers/{categoryId}', [CategoriesController::class, 'getCategoryManagers']);
Route::get('/getPayerStatistics/{Id}', [ClientsController::class, 'getPayerStatistics']);

Route::get('/getManagerDetails/{id}', [ManagersController::class, 'getManagerDetails']);
