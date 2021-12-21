<?php

use App\Http\Controllers\CounterController;
use App\Http\Controllers\PageController;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\Chapter;

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

Route::get('/', [PageController::class, "index"]);
Route::get('/cryptocurrency', [PageController::class, "cryptocurrency"]);
Route::get("/video/{video:slug}", [PageController::class, "singleVideo"]);
Route::get("/dashboard",  [PageController::class, "dashboard"])->middleware("auth");
Route::get("/dashboard/post", [PageController::class, "post"])->middleware("auth");
Route::get("/dashboard/edit/{video:slug}", [PageController::class, "edit"])->middleware("auth");
Route::get('/contact', [PageController::class, "contact"]);
Route::post("/contact", [PageController::class, "sendMessage"]);

Route::put("/add-view/{video:slug}", [CounterController::class, "addView"]);
Route::put("/add-click/{chapter}", [CounterController::class, "addLinkClick"]);

Route::post("/dashboard/post", [VideoController::class, "post"])->middleware("cors");
Route::put("/dashboard/edit/{video:slug}", [VideoController::class, "edit"])->middleware("cors");
Route::put("/dashboard/reset-clicks/{chapter}", [CounterController::class, "resetClick"]);
Route::put("/dashboard/reset-views/{video:slug}", [CounterController::class, "resetViews"]);

Route::delete("/dashboard/delete/{video:slug}", [VideoController::class, "deleteVideo"])->middleware("auth");

// Comment from here to disable the account routes

Route::get("/login", [PageController::class, "login"])->middleware("guest")->name("login");
Route::get("/register", [PageController::class, "register"])->middleware("guest");
Route::post("/login", [UserController::class, "authenticate"]);
Route::post("/register", [UserController::class, "store"]);
Route::get("/logout", [UserController::class, "logout"]);

// Until here

Route::get("/dashboard/account", [PageController::class, "account"])->middleware("auth");

Route::put("/dashboard/account", [UserController::class, "update"])->middleware("cors");

Route::get("/tag/{tag}", [PageController::class, "tag"]);

Route::get("/search", [PageController::class, "search"]);
