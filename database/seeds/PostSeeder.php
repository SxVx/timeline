<?php

use Illuminate\Database\Seeder;
use Illuminate\Support;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class,100)->create();
    }
}
