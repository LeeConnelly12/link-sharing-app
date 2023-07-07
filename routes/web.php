<?php

use App\Http\Controllers\PreviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;

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

// Links
Route::get('/', [LinkController::class, 'index'])
    ->name('links')
    ->middleware('auth');

Route::post('/links', [LinkController::class, 'store'])
    ->name('links.store')
    ->middleware('auth');

// Profile
Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile')
    ->middleware('auth');

Route::post('/profile', [ProfileController::class, 'update'])
    ->name('profile.update')
    ->middleware('auth');

// Preview
Route::get('/preview', [PreviewController::class, 'index'])
    ->name('preview')
    ->middleware('auth');

Route::get('/previews/{user}', [PreviewController::class, 'show'])
    ->name('previews.show');

require __DIR__.'/auth.php';
