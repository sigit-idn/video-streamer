<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            "videos" => Video::latest()->paginate(12),
            "title" => "Home"
        ]);
    }

    public function cryptocurrency()
    {
        return view('pages.cryptocurrency', [
            "title" => "Donation via Cryptocurrency"
        ]);
    }

    public function singleVideo(Video $video)
    {
        $videoCount = Video::count();
        $videos = Video::all();
        if ($videoCount >= 6) {
            $videos = $videos->random((6));
        }

        return view("pages.single-video", [
            "video" => $video,
            "videos" => $videos,
            "title" => $video["title"]
        ]);
    }

    public function dashboard()
    {
        return view('dashboard.index', [
            "videos" => Video::where("user_id", Auth::user()->id)->get(),
            "title" => "Dashboard"
        ]);
    }

    public function post()
    {
        return view("dashboard.post", [
            "title" => "Post a Video"
        ]);
    }

    public function edit(Video $video)
    {
        return view("dashboard.edit", [
            "video" => $video,
            "title" => "Edit Video"
        ]);
    }

    public function login()
    {
        return view("login", ["title" => "Login"]);
    }

    public function register()
    {
        return view("register", ["title" => "Register"]);
    }

    public function account()
    {
        return view("dashboard.account", [
            "title" => "Account"
        ]);
    }

    public function tag($tag)
    {
        $videos = Video::where("title", "like", "%$tag%")
            ->orWhere("tags", "like", "%$tag%")
            ->orWhere("description", "like", "%$tag%")
            ->distinct()
            ->get();

        foreach (Chapter::where("chapter_name", "like", "%$tag%")->distinct()->get()
            as $chapter) {
            $videos->push($chapter->video);
        };

        return view("pages.search", [
            "title" => "Videos in tag",
            "tag" => $tag,
            "videos" => $videos->unique()
        ]);
    }

    public function search(Request $request)
    {
        if ($request->by == "" || $request->by == "all") {
            $videos = Video::where("title", "like", "%$request->s%")
                ->with('chapters')
                ->orWhere("tags", "like", "%$request->s%")
                ->orWhere("description", "like", "%$request->s%")
                ->distinct()
                ->get();

            foreach (Chapter::where("chapter_name", "like", "%$request->s%")
                ->distinct()
                ->get()
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
            $videos =
                Chapter::where("chapter_name", "like", "%$request->s%")
                ->with('video')
                ->distinct()
                ->get()
                ->map(
                    function ($clip) {
                        return $clip->video;
                    }
                );

            return view("pages.search", [
                "title" => "Search results",
                "search" => $request->s,
                "videos" => $videos->unique()
            ]);
        } else {
            $videos = Video::where("$request->by", "like", "%$request->s%")
                ->distinct()
                ->get();

            return view("pages.search", [
                "title" => "Search results",
                "search" => $request->s,
                "videos" => $videos->unique()
            ]);
        }
    }
}