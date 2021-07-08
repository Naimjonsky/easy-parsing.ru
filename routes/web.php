<?php

use App\Http\Controllers\LogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ParseController;
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

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/logs', [LogController::class, 'index'])->name('logs');
Route::get('/logs/{log}', [LogController::class, 'show'])->name('logs.log');

Route::get('/parse', [ParseController::class, 'parseNews'])->name('parseNews');
