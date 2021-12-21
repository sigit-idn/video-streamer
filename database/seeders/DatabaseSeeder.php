<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Mirror;
use App\Models\User;
use App\Models\Video;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        User::create([
            "name" => "admin",
            "username" => "admin",
            "email" => "admin@email.com",
            "is_admin" => true,
            "password" => bcrypt("password"),
        ]);
        User::create([
            "name" => "user",
            "username" => "user",
            "email" => "user@email.com",
            "is_admin" => false,
            "password" => bcrypt("password"),
        ]);

        User::factory(6)->create();

        Video::factory(60)->create();
        Chapter::factory(100)->create();
        Mirror::factory(100)->create();
    }
}
