<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\PostImage;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = \App\Models\Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(4,true),
            'description' => $this->faker->sentence(),
        ];
    }
}
