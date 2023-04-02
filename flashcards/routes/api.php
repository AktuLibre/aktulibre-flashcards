<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;

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

Route::post( '/login', [ ApiAuthController::class, 'login' ]);
Route::post( '/user', [ ApiAuthController::class, 'register' ]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
