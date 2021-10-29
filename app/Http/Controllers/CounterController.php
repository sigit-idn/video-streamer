<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Chapter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    public function addView(Video $video)
    {
        $video->update(
            ["page_views" => $video["page_views"] + 1]
        );

        return "Page views increased";
    }

    public function addLinkClick(Chapter $chapter)
    {
        $chapter->update(
            ["button_clicks" => $chapter["button_clicks"] + 1]
        );

        return "Page Views increased";
    }

    public function resetClicks(Chapter $chapter)
    {
        $chapter->update(["button_clicks" => 0]);

        return "Button clicks couter reseted";
    }

    public function resetViews(Video $video)
    {
        $video->update(["page_views" => 0]);

        return "Page views couter reseted";
    }
}