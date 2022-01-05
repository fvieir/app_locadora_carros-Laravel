<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = \App\Models\PostImage::class;

    public function definition()
    {
        return [
            'image' => $this->faker->image(null,640,480)
        ];
    }
}
