<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::controller(AuthController::class)->group(function () {
	Route::get("", "index")->name("login");
	Route::post("login/stored", "login")->name("login.stored");
});

Route::middleware("auth")->group(function () {

	Route::get("logout", [AuthController::class, "logout"])->name("logout");
	Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");
});
