<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Chapter;
use App\Models\Mirror;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class VideoController extends Controller
{
    public function post(Request $request)
    {
        $chapters = [];
        $validatedData = $request->validate([
            "title" => 'required',
            "thumbnail" => 'image|file',
            "tags" => "nullable",
            "description" => "nullable",
            "answer" => "regex:/^\s*$request->right_answer$\s*/"
        ]);

        // foreach ($validatedData["video_url"] as $i => $videoUrl) {
        //     $urlIndex = $i == 0 ? "" : "_" . $i + 1;
        //     $validatedData["video_url$urlIndex"] = $videoUrl;
        // };

        $validatedData["user_id"] = Auth::user()->id;
        $validatedData["thumbnail"] = $request->file("thumbnail") ? $request->file("thumbnail")->store("thumbnails") : "";
        $validatedData["slug"] = SlugService::createSlug(Video::class, "slug", $validatedData["title"], ["unique" => true]);

        unset($validatedData["answer"]);
        $video = Video::create($validatedData);

        $validatedUrls = $request->validate([
            "video_url.*" => ['nullable', 'regex:/.*http.+\..+/'],
            "video_url.0" => ['required', 'regex:/.*http.+\..+/'],
            "video_label.*" => "max:20"
        ]);

        foreach ($validatedUrls["video_label"] as $i => $validatedLabel) {
            if ($validatedUrls["video_url"][$i]) {
                Mirror::create([
                    "video_label" => $validatedLabel,
                    "video_url" => $validatedUrls["video_url"][$i],
                    "video_id" => $video->id
                ]);
            };
        }


        if ($request->get("start_pos")) {

            foreach ($request->get("start_pos") as $i => $startPos) {
                $urls = [];
                preg_match("/^http.+\..+/", $request->get("url")[$i], $urls);

                $chapter = [
                    "video_id" => $video->id,
                    "start_pos" => $startPos,
                    "end_pos" => $request->get("end_pos")[$i],
                    "chapter_name" => $request->get("chapter_name")[$i],
                    "url" =>  $urls ? $urls[0] : "",
                ];

                $chapters[] = $chapter;

                Chapter::create($chapter);
            }
        }


        return redirect("/dashboard")->with("success", "Created video '$video->title' Successfully");
    }

    public function edit(Video $video, Request $request)
    {
        $chapters = [];

        $validatedData = $request->validate([
            "title" => 'required',
            "thumbnail" => 'image|file',
            "tags" => "nullable",
            "description" => "nullable"
        ]);


        $validatedUrls = $request->validate([
            "video_url.*" => ['nullable', 'regex:/.*http.+\..+/'],
            "video_url.0" => ['required', 'regex:/.*http.+\..+/'],
            "video_label.*" => "max:20"
        ]);

        Mirror::where("video_id", $video->id)->delete();

        foreach ($validatedUrls["video_label"] as $i => $validatedLabel) {
            if ($validatedUrls["video_url"][$i]) {
                Mirror::create([
                    "video_label" => $validatedLabel,
                    "video_url" => $validatedUrls["video_url"][$i],
                    "video_id" => $video->id
                ]);
            };
        }

        $validatedData["thumbnail"] = $request->file("thumbnail")
            ? $request->file("thumbnail")->store("thumbnails")
            : $request->thumbnailPreview;

        if (!$request->thumbnailPreview || $request->file('thumbnail')) {
            Storage::delete($video->thumbnail);
        }

        $video->update($validatedData);

        if ($request->get("start_pos")) {
            Chapter::where("video_id", $video->id)->delete();

            foreach ($request->get("start_pos") as $i => $startPos) {
                $urls = [];
                preg_match("/^http.+\..+/", $request->get("url")[$i], $urls);

                $chapter = [
                    "video_id" => $video->id,
                    "start_pos" => $startPos,
                    "end_pos" => $request->get("end_pos")[$i],
                    "chapter_name" => $request->get("chapter_name")[$i],
                    "url" =>  $urls ? $urls[0] : "",
                ];

                $chapters[] = $chapter;

                Chapter::create($chapter);
            }
        }

        return redirect("/dashboard")->with("success", "Edited video '$video->title' Successfully");
    }

    public function deleteVideo(Video $video)
    {
        $video->delete();
        Storage::delete($video->thumbnail);
        return redirect("/dashboard")->with("success", "Delete video '$video->title' successfully.");
    }
}