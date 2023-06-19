<?php

use App\Http\Controllers\DashController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('login', array(LoginController::class,'login'))->name("auth.login");
Route::post('doLogin',[LoginController::class,'doLogin'])->name("auth.doLogin");
Route::get('register',[RegisterController::class,'register'])->name("auth.register");
Route::post('doRegister',[RegisterController::class,'doRegister'])->name("auth.doRegister");

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', fn() => redirect()->route('index'));
    Route::get('/maps',[App\Http\Controllers\BusRouteController::class,'index'])->name('index');
    Route::post('logout',[LoginController::class,'logout'])->name("auth.logout");
});


