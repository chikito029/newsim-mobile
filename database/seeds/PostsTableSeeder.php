<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\PostImage;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        // Create 23 Post with minimum number of Images of 0
        // and maximum number of 10 for each Post created.
        factory(Post::class, 23)->create()->each(function ($post) {
            for ($i=0; $i < rand(0, 10); $i++) {
                $post->postImages()->save(factory(PostImage::class)->make());
            }
        });
    }
}
