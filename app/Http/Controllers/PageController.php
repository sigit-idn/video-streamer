<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    public function contact()
    {
        $question = "What is the geometric figure of X square + Y square = 8?"; //Write the verification question here
        return view('pages.contact', [
            "title" => "Contact Us",
            "question" => $question
        ]);
    }

    public function sendMessage(Request $request)
    {
        $answer = "circle"; //Write the verification answer here
        $to = "sigit.idn@gmail.com"; //Change with your email
        $subject = $request->title;

        $message = "
        Sender Name: $request->name
        Sender Email: $request->email
        Message:
        $request->message
        ";

        if (
            trim(strtolower($request->verification))
            !=
            trim(strtolower($answer))
        ) {
            return Redirect::back()
                ->withInput()
                ->with("verification", "Your answer is incorrect");
        }

        mail($to, $subject, $message);

        return "
        <script>
            alert('Message Sent successfully')
            window.location.href = '/'
        </script>
        ";
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
        if (Auth::user()->is_admin) {
            $videos = Video::all();
        } else {
            $videos = Video::where("user_id", Auth::user()->id)->get();
        }

        return view('dashboard.index', [
            "videos" => $videos,
            "title" => "Dashboard"
        ]);
    }

    public function post()
    {
        $question = "What is the geometric figure of X square + Y square = 8?"; //Write the verification question here
        $answer = "circle"; //Write the verification answer here
        return view("dashboard.post", [
            "title" => "Post a Video",
            "question" => $question,
            "answer" => $answer
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

        $videos = collect($videos);

        $videos = $videos->filter(function ($video) {
            return $video != null;
        });

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
            $videos = collect($videos);

            $videos = $videos->filter(function ($video) {
                return $video != null;
            });

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