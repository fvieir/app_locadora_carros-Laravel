<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostImage;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::factory()->count(30)->create()->each(function($post) {
            $post->post_images()->save(
                \App\Models\PostImage::factory()->make()
            );
        });
    }
}
