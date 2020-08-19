<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'category_id' => rand(2, 4),
        'title' => $faker->sentence(),
        'slug' => Str::slug($faker->sentence()),
        'body' => $faker->paragraph(10),
    ];
});
