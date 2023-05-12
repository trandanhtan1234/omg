<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AccController;
use App\Http\Controllers\backend\LoginController;
// use App\Http\Controllers\backend;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', [LoginController::class, 'Index'])->middleware('CheckLogout');
Route::post('login', [LoginController::class, 'Login'])->name('login');
Route::get('logout', [LoginController::class, 'Logout'])->name('logout');

Route::get('ttt', [LoginController::class, 'ttt']);

Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogin'], function() {
    Route::get('acc', [AccController::class, 'Index']);
});
