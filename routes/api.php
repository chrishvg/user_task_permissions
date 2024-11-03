<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', [UserController::class, 'store']);
Route::put('/user', [UserController::class, 'update']);
Route::delete('/user', [UserController::class, 'destroy']);
Route::post('/permission', [PermissionController::class, 'store']);
Route::delete('/permission', [PermissionController::class, 'destroy']);
Route::post('/assign', [AssignController::class, 'store']);
Route::delete('/assign', [AssignController::class, 'destroy']);

//Tasks
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/task', [TaskController::class, 'store']);
Route::put('/task', [TaskController::class, 'update']);
Route::post('/task/done', [TaskController::class, 'markAsDone']);
Route::post('/task/search', [TaskController::class, 'search']);
Route::delete('/task', [TaskController::class, 'destroy']);

