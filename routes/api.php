<?php

use App\Http\Controllers\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'prefix' => 'leads',
    ],
    function () {
        Route::post(
            '/',
            [LeadController::class, 'store']
        );
        Route::get(
            '/confirm-email/{id}',
            [LeadController::class, 'confirmEmail']
        )
        ->middleware(['signed', 'throttle:6,1'])
        ->name('leads.confirm-email');
    }
);

// criar rota de teste ping
Route::get(
    '/ping',
    function () {
        return ['pong' => true];
    }
);
