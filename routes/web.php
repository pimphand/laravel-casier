<?php

use App\Http\Controllers\Api\Auth\SocialAuthController;
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


Route::prefix('/auth/social/{provider}')->group(function () {
    Route::get('/', [SocialAuthController::class,'redirectToProvider']);
    Route::get('/callback', [SocialAuthController::class,'handleCallback']);
});

