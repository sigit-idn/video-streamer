<?php

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ChapterController;

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
    return view('pages.home', [
        "videos" => Video::orderByDesc("id")->paginate(12),
        "title" => "Home"
    ]);
});

Route::get("/video/{video:slug}", function(Video $video) {
    return view("pages.single-video", [
        "video" => $video,
        "videos" => Video::all()->random(6),
        "title" => $video["title"]
    ]);
});

Route::get("/dashboard",  function () {
    return view('dashboard.index', [
        "videos" => Video::where("user_id", Auth::user()->id)->get(),
        "title" => "Dashboard"
    ]);
})->middleware("auth");

Route::get("/dashboard/post", function() {
    return view("dashboard.post", [
        "title" => "Post a Video"
    ]);
})->middleware("auth");

Route::post("/dashboard/post", [VideoController::class, "post"])->middleware("auth");

Route::get("/dashboard/edit/{video:slug}", function(Video $video) {
    return view("dashboard.edit", [
        "video" => $video,
        "title" => "Edit Video"
    ]);
})->middleware("auth");

Route::put("/dashboard/edit/{video:slug}", [VideoController::class, "edit"])->middleware("auth");
Route::delete("/dashboard/delete/{video:slug}", function(Video $video) {
    $video->delete();
    Storage::delete($video->thumbnail);
    return redirect("/dashboard")->with("success", "Delete video '$video->title' successfully.");
})->middleware("auth");

Route::get("/login", function() {
    return view("login", ["title" => "Login"]);
})->middleware("guest")->name("login");

Route::post("/login", [UserController::class, "authenticate"])->middleware("guest");

Route::get("/register", function() {
    return view("register", ["title" => "Register"]);
})->middleware("guest");

Route::post("/register", [UserController::class, "store"]);

Route::get('/logout', [UserController::class, "logout"]);

Route::get("/dashboard/account", function() {
    return view("dashboard.account", [
        "title" => "Account"
    ]);
})->middleware("auth");

Route::put("/dashboard/account", [UserController::class, "update"]);

Route::get("/tag/{tag}", function($tag) {
    return view("pages.search", [
        "title" => "Videos in tag",
        "tag" => $tag,
        "videos" => Video::where("tags", "like", "%$tag%")->paginate(12)]);
});

Route::get("/search", function(Request $request) {
    return view("pages.search", [
        "title" => "Search results",
        "videos" => Video::where("title", "like", "%$request->s%")->paginate(12)]);
});
