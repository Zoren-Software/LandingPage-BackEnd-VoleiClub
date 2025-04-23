<?php

use App\Http\Controllers\Auth\SanctumController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LeadInteractionController;
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

Route::group(['prefix' => 'leads'], function () {
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

        Route::get(
            '/{leadId}/interactions',
            [
                LeadInteractionController::class,
                'index',
            ]
        )
            ->name('interactions.index');

        Route::delete(
            '/{lead}/interactions/{interaction}',
            [
                LeadInteractionController::class,
                'destroy',
            ]
        )
            ->name('leads.interactions.destroy');

        Route::put(
            '/{lead}/interactions/{interaction}',
            [
                LeadInteractionController::class,
                'update',
            ]
        )
            ->name('leads.interactions.update');
    }
);

Route::post(
    '/login',
    [SanctumController::class, 'login']
)
    ->name('login');

Route::post(
    '/logout',
    [SanctumController::class, 'logout']
)
    ->name('logout')
    ->middleware(['auth:sanctum']);

Route::prefix('/leads')->name('leads.')->middleware('auth:sanctum')->group(
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
);

// NOTE - criar rota de teste ping
Route::get(
    '/ping',
    function () {
        return ['pong' => true];
    }
);
