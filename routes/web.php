<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivescoreController;
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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/status',[LivescoreController::class,'status'])->name('status');
Route::get('/timezone',[LivescoreController::class,'timezone'])->name('timezone');
Route::get('/',[LivescoreController::class,'home'])->name('home');
Route::get('/fixtures_local',[LivescoreController::class,'fixtures_local'])->name('fixtures_local');
Route::get('/showToken',[LivescoreController::class,'showToken'])->name('showToken');
Route::get('/about',[\App\Http\Controllers\TestController::class,'about'])->name('test.about');
Route::get('/sidebar',[\App\Http\Controllers\TestController::class,'sidebar'])->name('sidebar');
