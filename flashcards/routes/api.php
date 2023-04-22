<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiQuizController;
use App\Http\Controllers\Api\ApiLibraryController;

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
Route::post( '/register', [ ApiAuthController::class, 'register' ]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

Route::middleware( 'auth:sanctum' )->group( function () {

    /**
     * Quiz endpoints
     */
    Route::get( '/decks/{deck}/quiz', [ ApiQuizController::class, 'get' ] );
    Route::post( '/quiz/item/{quizItem}/progress', [ ApiQuizController::class, 'report_quiz_item_progress' ]);
    
    Route::get( '/library', [ ApiLibraryController::class, 'index' ]);
});
