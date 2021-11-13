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
        return [
            "video_id" => mt_rand(1, 10),
            "video_url" => "https://www.youtube.com/watch?v=" . $this->faker->regexify("(\w|\d){11}"),
            "video_label" => "Mirror " . mt_rand(1, 8),
        ];
    }
}