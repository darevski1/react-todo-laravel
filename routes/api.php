<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-new', [TodoController::class, 'create']);
Route::get('/all', [TodoController::class, 'all']);
Route::get('/get-status/{status}/user/{id}', [TodoController::class, 'getbyStatus']);
Route::get('/get-by-user-id/{id}', [TodoController::class, 'getbyUserId']);
Route::get('/update/{id}', [TodoController::class, 'update']);
Route::delete('/delete/{id}', [TodoController::class, 'delete']);
Route::patch('/closeTodo/{id}', [TodoController::class, 'closeTodo']);

Route::group(['middleware' => ['auth:sanctum']], function () {
});