<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Album::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'year' => $faker->year($max = 'now'),
        'image' => $faker->text
    ];
});
