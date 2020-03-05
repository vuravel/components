<?php 

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Vuravel\Components\Tests\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'published_at' => $faker->date,
        'user_id' => 1
    ];
});