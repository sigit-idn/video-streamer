<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1, 6),
            "title" => $this->faker->words(3, true),
            "slug" => $this->faker->slug(),
            "tags" => implode(",", $this->faker->words()),
            "description" => $this->faker->paragraphs(2, true),
        ];
    }
}