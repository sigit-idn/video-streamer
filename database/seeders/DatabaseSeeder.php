<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Mirror;
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
        // User::factory(6)->create();

        // Video::create([
        //     "title" => "Travel Guide Kyoto",
        //     "user_id" => mt_rand(1, 6),
        //     "slug" => "travel-guide-kyoto",
        //     "video_url" => "https://www.youtube.com/watch?v=Jd1wzlwtKJ0",
        // ]);

        // Video::create([
        //     "title" => "Walking Around Kyoto",
        //     "user_id" => mt_rand(1, 6),
        //     "slug" => "walking-around-kyoto",
        //     "video_url" => "https://www.youtube.com/watch?v=iEK9kSHmdgo",
        // ]);

        // Video::create([
        //     "title" => "Sunset In Kiyomizudera",
        //     "user_id" => mt_rand(1, 6),
        //     "slug" => "sunset-in-kiyomizudera",
        //     "video_url" => "https://www.youtube.com/watch?v=q48xVf-AbmA",
        // ]);

        User::create([
            "name" => "admin",
            "username" => "admin",
            "email" => "admin@email.com",
            "is_admin" => true,
            "password" => bcrypt("password"),
        ]);

        // Video::factory(10)->create();
        // Chapter::factory(100)->create();
        // Mirror::factory(60)->create();
    }
}