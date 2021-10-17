<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(6)->create();

        Video::create([
            "title" => "Travel Guide Kyoto",
            "user_id"=> mt_rand(1, 10),
            "slug" => "travel-guide-kyoto",
            "video_url" => "https://www.youtube.com/watch?v=Jd1wzlwtKJ0",
            // "category" => "Religion"
        ]);

        Video::create([
            "title" => "Walking Around Kyoto",
            "user_id"=> mt_rand(1, 10),
            "slug" => "walking-around-kyoto",
            "video_url" => "https://www.youtube.com/watch?v=iEK9kSHmdgo",
            // "category" => "Religion"
        ]);

        Video::create([
            "title" => "Sunset In Kiyomizudera",
            "user_id"=> mt_rand(1, 10),
            "slug" => "sunset-in-kiyomizudera",
            "video_url" => "https://www.youtube.com/watch?v=q48xVf-AbmA",
            // "category" => "Religion"
        ]);

        Video::factory(20)->create();
        Chapter::factory(200)->create();
    }
}
