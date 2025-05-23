<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/confirm-email', function () {
    $lead = App\Models\Lead::find(2);

    return new App\Mail\ConfirmEmail($lead);
});

Route::get('/unsubscribe-email', function () {
    $lead = App\Models\Lead::find(2);

    return new App\Mail\ConfirmUnsubscribeEmail($lead);
});

Route::get('/after-confirm-email', function () {
    $lead = App\Models\Lead::find(2);

    return new App\Mail\AfterConfirmationEmail($lead);
});
