<?php

namespace Database\Factories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chapter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "video_id" => mt_rand(1, 20),
            "start_pos" => $this->faker->time(),
            "end_pos" => $this->faker->time(),
            "chapter_name" => $this->faker->sentence(),
            "url" => $this->faker->url()
        ];
    }
}
