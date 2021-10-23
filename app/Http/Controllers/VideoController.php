<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class VideoController extends Controller
{
    public function post(Request $request) {
        $chapters = [];
        $validatedData = $request->validate([
            "title" => 'required',
            "video_url.*" => ['nullable', 'regex:/.*http.+\..+/'],
            "video_url.0" => ['required', 'regex:/.*http.+\..+/'],
            "thumbnail" => 'image|file',
            "tags" => "nullable",
            "description" => "nullable"
        ]);

        $validatedData["video_url_2"] = $validatedData["video_url"][1];
        $validatedData["video_url_3"] = $validatedData["video_url"][2];
        $validatedData["video_url_4"] = $validatedData["video_url"][3];
        $validatedData["video_url_5"] = $validatedData["video_url"][4];
        $validatedData["video_url"] = $validatedData["video_url"][0];
        $validatedData["user_id"] = Auth::user()->id;
        $validatedData["thumbnail"] = $request->file("thumbnail") ? $request->file("thumbnail")->store("thumbnails") : "";
        $validatedData["slug"] = SlugService::createSlug(Video::class, "slug", $validatedData["title"], ["unique" => true]);

        $video = Video::create($validatedData);

        if ($request->get("start_pos")) {


            foreach($request->get("start_pos") as $i => $startPos) {
                $urls = [];
                preg_match("/^http.+\..+/", $request->get("url")[$i], $urls);

                // $request->validate([
                //     "start_pos" => "required|regex:/\d{1,2}:\d{1,2}:\d{1,2}/",
                //     "end_pos" => "required|regex:/\d{1,2}:\d{1,2}:\d{1,2}/",
                //     "chapter_name" => "required",
                //     "url" =>  "nullable|url",
                // ]);

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

    public function edit(Video $video, Request $request) {
        $chapters = [];

        $validatedData = $request->validate([
            "title" => 'required',
            "video_url.*" => 'nullable|url',
            "video_url.0" => 'required',
            "thumbnail" => 'image|file',
            "tags" => "nullable",
            "description" => "nullable"
        ]);

        $validatedData["video_url_2"] = $validatedData["video_url"][1];
        $validatedData["video_url_3"] = $validatedData["video_url"][2];
        $validatedData["video_url_4"] = $validatedData["video_url"][3];
        $validatedData["video_url_5"] = $validatedData["video_url"][4];
        $validatedData["video_url"] = $validatedData["video_url"][0];
        $validatedData["thumbnail"] = $request->file("thumbnail")
        ? $request->file("thumbnail")->store("thumbnails")
        : $request->thumbnailPreview;

        if (!$request->thumbnailPreview || $request->file('thumbnail')) {
            Storage::delete($video->thumbnail);
        }

        $video->update($validatedData);

        if ($request->get("start_pos")) {
            Chapter::where("video_id", $video->id)->delete();

            foreach($request->get("start_pos") as $i => $startPos) {
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

    public function resetClicks(Video $video) {
        $video->update(["page_clicks" => 0]);

        return "Page clicks couter reseted";
    }

    public function resetViews(Video $video) {
        $video->update(["page_views" => 0]);

        return "Page views couter reseted";
    }
}
