<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        factory(Post::class, 30)->create()
            ->each(function ($post) use ($user) {
                $user->posts()->save($post);
            });
    }
}
