<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\BranchController;
use App\Http\Controllers\API\V1\PersonController;

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

Route::group(['prefix' => 'v1'], function() {

    //Public Routes
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    //Protected Routes
    Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    // Route::post('/auth/logout', function(Request $request) {
    //     return $request->user()->currentAccessToken()->delete();
    // })->middleware('auth:sanctum');

    //Person
    Route::apiResource('person', PersonController::class);
		
		//Branch		
		Route::apiResource('branch', BranchController::class);

    });

});
