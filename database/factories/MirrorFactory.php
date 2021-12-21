<?php

namespace Database\Factories;

use App\Models\Mirror;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class MirrorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mirror::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $videoUrls = [
            "https://www.youtube.com/watch?v=s2WN2_TIyPA",
            "https://www.youtube.com/watch?v=bDHObXuNg-I",
            "https://www.youtube.com/watch?v=0L3qxAVlcHs",
            "https://www.youtube.com/watch?v=72EkaiTzuNs",
            "https://www.youtube.com/watch?v=fsKXDTqWhV0",
            "https://www.youtube.com/watch?v=2tirA2yrlVc",
            "https://www.youtube.com/watch?v=t7f36ZFdSG4",
            "https://www.youtube.com/watch?v=7tdWKi0KxHM",
            "https://www.youtube.com/watch?v=MAtygp9bSkA",
            "https://www.youtube.com/watch?v=1UkRkTHQ6l8",
            "https://www.youtube.com/watch?v=ajij_Y3cWuU",
            "https://www.youtube.com/watch?v=PSn4qj-L3IU",
            "https://www.youtube.com/watch?v=FD9X71Y3XxA",
            "https://www.youtube.com/watch?v=cGGn0u5NaPY",
            "https://www.youtube.com/watch?v=_xXHpzCBtD8",
            "https://www.youtube.com/watch?v=c3uJUrvI2zc",
            "https://www.youtube.com/watch?v=It-V8_5WbF4",
            "https://www.youtube.com/watch?v=cg_kcaymWK0",
            "https://www.youtube.com/watch?v=2xjG3wvazO8",
            "https://www.youtube.com/watch?v=TDOafWPNXoQ",
            "https://www.youtube.com/watch?v=TGZBnsLHglM",
            "https://www.youtube.com/watch?v=z8U-UHilOsI",
            "https://www.youtube.com/watch?v=jA7Nl2YXYdY",
            "https://www.youtube.com/watch?v=mKyoRmm0uu8",
            "https://www.youtube.com/watch?v=AQ_rZx91fLU",
            "https://www.youtube.com/watch?v=J3sQkKmwy0M",
            "https://www.youtube.com/watch?v=bupmyHHhMAo",
            "https://www.youtube.com/watch?v=U77CPJrqH_k",
            "https://www.youtube.com/watch?v=oavxu0Y7fBo",
            "https://www.youtube.com/watch?v=ZaJk-t1qa_0",
            "https://www.youtube.com/watch?v=W-BIsulO-VU",
            "https://www.youtube.com/watch?v=CwsuMUiztF0",
            "https://www.youtube.com/watch?v=zA4w4cSkSlI",
            "https://www.youtube.com/watch?v=4JHz7fYKUTA",
            "https://www.youtube.com/watch?v=vpmiGXFcN9w",
            "https://www.youtube.com/watch?v=qTztnS3yZLA",
            "https://www.youtube.com/watch?v=Q98ACV6SVe8",
            "https://www.youtube.com/watch?v=av4OGgaQU5I",
            "https://www.youtube.com/watch?v=_yze76Ew1NE",
            "https://www.youtube.com/watch?v=Rl96LBNCvOE",
            "https://www.youtube.com/watch?v=C6MGxh-FcWI",
            "https://www.youtube.com/watch?v=X1uyi9TmWFk",
            "https://www.youtube.com/watch?v=HHk8rm9DUKw",
            "https://www.youtube.com/watch?v=cUj5SuapfzY",
            "https://www.youtube.com/watch?v=rte-9W4LdIM",
            "https://www.youtube.com/watch?v=nq2bVYd_cQs",
            "https://www.youtube.com/watch?v=vNZYLHgYzJI",
            "https://www.youtube.com/watch?v=NMrGCmHoKlE",
            "https://www.youtube.com/watch?v=XHXqWc9k7Wc",
            "https://www.youtube.com/watch?v=zdhyxJhdwTM",
            "https://www.youtube.com/watch?v=gD_oVRFf0Gg",
            "https://www.youtube.com/watch?v=MNjbIjpiQL4",
            "https://www.youtube.com/watch?v=a55WsLmcjAw",
            "https://www.youtube.com/watch?v=AKanwe_8MYo",
            "https://www.youtube.com/watch?v=QY2dyxVHkbI",
            "https://www.youtube.com/watch?v=Va85W6zbQAs",
            "https://www.youtube.com/watch?v=pOjX5yOoclo",
            "https://www.youtube.com/watch?v=0UMvPZH4_yY",
            "https://www.youtube.com/watch?v=X7Exubf3irY",
            "https://www.youtube.com/watch?v=IrX5C-68AaY"
        ];
        return [
            "video_id" => mt_rand(1, 60),
            "video_url" => $videoUrls[mt_rand(0, count($videoUrls) - 1)],
            "video_label" => "Mirror " . mt_rand(1, 8),
        ];
    }
}
