<?php

use App\Post;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence,
        'sub_title'   => $faker->paragraph,
        'body'        => str_repeat('<p>' . $faker->text . '</p>', 10),
        'category_id' => Category::first()->id,
        'published'   => true,
    ];
});
