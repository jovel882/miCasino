<?php

use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

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

Route::controller(UrlController::class)->group(function () {
    Route::get('/', 'show')
        ->name('url');
    Route::post('/url', 'upload')
        ->name('upload');
    Route::get('/redirect', 'redirect')
        ->name('redirect');
});

Route::view('/generate', 'generate', ['maxUploadSize' => UploadHelper::maxUploadSize()])
    ->name('generate');
