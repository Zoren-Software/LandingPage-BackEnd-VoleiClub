<?php

use App\Http\Controllers\Auth\SanctumController;
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

Route::post(
    '/login',
    [SanctumController::class, 'login']
)
->name('login');

Route::group(
    [
        'prefix' => 'leads',
    ],
    function () {
        Route::put(
            '/{id}',
            [LeadController::class, 'alterStatusLead']
        );
        Route::get(
            '/',
            [LeadController::class, 'list']
        );
    }
)->middleware('auth:sanctum');

// NOTE - criar rota de teste ping
Route::get(
    '/ping',
    function () {
        return ['pong' => true];
    }
);
