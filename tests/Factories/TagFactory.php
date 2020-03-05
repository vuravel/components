<?php 

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Vuravel\Components\Tests\Models\Tag;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});