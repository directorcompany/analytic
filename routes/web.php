<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/save', [HomeController::class, 'store'])->name('store');
Route::get('/artisan',[ManagerController::class,'artisan']);
Route::group(['middleware'=>'auth','prefix'=>'admin'],function() {
    Route::get('/', [ManagerController::class, 'index'])->name('manager');
    Route::get('/url', [ManagerController::class, 'show'])->name('url');
    Route::get('/urlstore/{id?}', [ManagerController::class, 'store'])
    ->name('urlstore')
    ->middleware('throttle:100,1')
    ->where('id','[0-9]+');
  
});