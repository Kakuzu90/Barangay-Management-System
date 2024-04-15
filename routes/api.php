<?php

use App\Http\Controllers\Api\AvatarController;
use App\Http\Controllers\Api\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::as("api.")->middleware("auth")->group(function () {

	Route::get("resident/search", [SearchController::class, "search"])->name("search");
	Route::get("resident/profile/{profile}", [AvatarController::class, "index"])->name("avatar");
});
