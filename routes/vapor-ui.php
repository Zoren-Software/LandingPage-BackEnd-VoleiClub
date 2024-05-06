<?php

use App\Http\Controllers\Auth\LoginGitHubController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/vapor/login', function () {
    return view('welcome-vapor-ui');
})->name('welcome-vapor-ui');

Route::get('/logout', [LoginGitHubController::class, 'logout'])->name('logout');

Route::get('/auth/github/redirect', [LoginGitHubController::class, 'githubRedirect'])->name('github.login');

Route::get('/auth/github/callback', [LoginGitHubController::class, 'githubCallback']);
