<?php

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

Route::put("/add-view/{video:slug}", function(Video $video) {
    $video->update(
        ["page_views" => $video["page_views"] + 1]
    );

    return "Page Views increased";
});

Route::put("/add-click/{chapter}", function(Chapter $chapter) {
    $chapter->update(
        ["button_clicks" => $chapter["button_clicks"] + 1]
    );

    return "Page Views increased";
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

Route::post("/dashboard/post", [VideoController::class, "post"])->middleware("cors");

Route::get("/dashboard/edit/{video:slug}", function(Video $video) {
    return view("dashboard.edit", [
        "video" => $video,
        "title" => "Edit Video"
    ]);
})->middleware("auth");

Route::put("/dashboard/edit/{video:slug}", [VideoController::class, "edit"])->middleware("auth");
Route::put("/dashboard/reset-clicks/{chapter}", function (Chapter $chapter) {
    $chapter->update(["button_clicks" => 0]);

    return "Button clicks couter reseted";
})->middleware("auth");
Route::put("/dashboard/reset-views/{video:slug}", [VideoController::class, "resetViews"])->middleware("auth");

Route::delete("/dashboard/delete/{video:slug}", function(Video $video) {
    $video->delete();
    Storage::delete($video->thumbnail);
    return redirect("/dashboard")->with("success", "Delete video '$video->title' successfully.");
})->middleware("auth");

// Comment from here to disable the account routes

Route::get("/login", function() {
    return view("login", ["title" => "Login"]);
})->middleware("guest")->name("login");

Route::get("/register", function() {
    return view("register", ["title" => "Register"]);
})->middleware("guest");

Route::post("/login", [UserController::class, "authenticate"]);
Route::post("/register", [UserController::class, "store"]);

Route::get('/logout', [UserController::class, "logout"]);

// Until here

Route::get("/dashboard/account", function() {
    return view("dashboard.account", [
        "title" => "Account"
    ]);
})->middleware("auth");

Route::put("/dashboard/account", [UserController::class, "update"])->middleware("cors");

Route::get("/tag/{tag}", function($tag) {
    $videos = Video::where("title", "like", "%$tag%")
    ->orWhere("tags", "like", "%$tag%")
    ->orWhere("description", "like", "%$tag%")
    ->distinct()
    ->get();

    foreach (
        Chapter::where("chapter_name", "like", "%$tag%")->distinct()->get()
        as $chapter) {
            $videos->push($chapter->video);
        };

    return view("pages.search", [
        "title" => "Videos in tag",
        "tag" => $tag,
        "videos" => $videos->unique()
    ]);
});

Route::get("/search", function(Request $request) {
    if($request->by == "" || $request->by == "all") {
        $videos = Video::where("title", "like", "%$request->s%")
        ->orWhere("tags", "like", "%$request->s%")
        ->orWhere("description", "like", "%$request->s%")
        ->distinct()
        ->get();

        foreach (
            Chapter::where("chapter_name", "like", "%$request->s%")->distinct()->get()
            as $chapter) {
                $videos->push($chapter->video);
            };

        return view("pages.search", [
            "title" => "Search results",
            "search" => $request->s,
            "videos" => $videos->unique()
        ]);
    }
    if ($request->by == "clips") {
        $videos = Chapter::where("chapter_name", "like", "%$request->s%")
        ->distinct()
        ->get()
        ->map(
            function ($clip) {
            return $clip->video;
        });

        return view("pages.search", [
            "title" => "Search results",
            "search" => $request->s,
            "videos" => $videos->unique()
        ]);
    }
    else {
        $videos = Video::where("$request->by", "like", "%$request->s%")
        ->distinct()
        ->get();

        return view("pages.search", [
            "title" => "Search results",
            "search" => $request->s,
            "videos" => $videos->unique()
        ]);
    }


});
