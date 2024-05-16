<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlotterController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OfficialController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurokController;
use App\Http\Controllers\PurokLeaderController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WelcomeController;
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

Route::get("", WelcomeController::class)->name("welcome");

Route::middleware("guest")->group(function () {
	Route::controller(AuthController::class)->group(function () {
		Route::get("login", "index")->name("login");
		Route::post("login/stored", "login")->name("login.stored");
	});
	Route::controller(RegisterController::class)->group(function () {
		Route::get("sign-up", "index")->name("sign-up.index");
		Route::post("sign-up/stored", "store")->name("sign-up.store");
	});
});

Route::middleware("auth")->group(function () {

	Route::get("logout", [AuthController::class, "logout"])->name("logout");
	Route::get("dashboard", [DashboardController::class, "index"])->name("dashboard");

	Route::apiResource("events", EventController::class);
	Route::get("sms", [SMSController::class, "index"])->name("sms.index");
	Route::apiResource("puroks", PurokController::class);
	Route::apiResource("positions", PositionController::class);
	Route::get("residents/{resident}/ajax", [ResidentController::class, "ajax"])->name("residents.ajax");
	Route::resource("residents", ResidentController::class);
	Route::get("purok-leaders/active", [PurokLeaderController::class, "active"])->name("purok-leaders.active");
	Route::apiResource("purok-leaders", PurokLeaderController::class);
	Route::resource("blotters", BlotterController::class);
	Route::get("officials/active", [OfficialController::class, "active"])->name("officials.active");
	Route::apiResource("officials", OfficialController::class);
	Route::controller(CertificateController::class)->prefix("certificate")->as("certificate.")->group(function () {
		Route::get("clearance-certificate", "index")->name("index");
		Route::get("birth-certificate", "birth")->name("birth");
		Route::get("large-cattle-certificate", "cattle")->name("cattle");
		Route::get("residence-certificate", "residence")->name("residence");
		Route::get("residence-sports-certificate", "sports")->name("sports");

		Route::post("clearance-certificate/generate", "storeIndex")->name("store");
		Route::post("birth-certificate/generate", "storeBirth")->name("store.birth");
		Route::post("large-cattle-certificate/generate", "storeCattle")->name("store.cattle");
		Route::post("residence-certificate/generate", "storeResidence")->name("store.residence");
		Route::post("residence-sports-certificate/generate", "storeSports")->name("store.sports");
	});
	Route::get("transactions", [TransactionController::class, "index"])->name("transactions.index");
	Route::controller(SettingController::class)->prefix("system-settings")->as("system-settings.")->group(function () {
		Route::get("", "index")->name("index");
		Route::put("{setting}", "update")->name("update");
	});
	Route::controller(ProfileController::class)->prefix("account-settings")->as("account-settings.")->group(function () {
		Route::get("", "index")->name("index");
		Route::put("general-info", "general")->name("general");
		Route::patch("account-info", "account")->name("account");
		Route::patch("password-info", "password")->name("password");
		Route::patch("avatar-info", "avatar")->name("avatar");
	});
});

Route::fallback(function () {
	abort(404);
});
