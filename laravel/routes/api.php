<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Sanctum\PersonalAccessToken;

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

Route::post('/user/auth/register', [AuthController::class, 'register']);
Route::post('/user/auth/login', [AuthController::class, 'login']);
Route::post('/user/auth/logout', [AuthController::class, 'logout']);
Route::put('/user/update', [AuthController::class, 'update']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('/user/password', [AuthController::class, 'updatePassword']);
});



Route::middleware('auth:sanctum')->get('/user', function(Request $request){
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/authentication', function (Request $request) {
    return true;
});
