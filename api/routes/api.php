<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Contact\ContactController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('admin')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout']);
    });

    Route::middleware('auth:api')->group(function() {
        Route::get('authuser', function (Request $request) {
            return $request->user();
        });

        // Contact Pages
        Route::prefix('contacts')->group(function() {
            Route::get('list', [ContactController::class, 'getList']);
            Route::post('add', [ContactController::class, 'addContact']);
        });
    });

    Route::get('/sampledata', function (Request $request) {
        return "Successsssfullll kaayo!!!!";
    });
});
