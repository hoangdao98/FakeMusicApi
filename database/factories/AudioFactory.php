<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Audio::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'album_id' => $faker->biasedNumberBetween($min = 10, $max = 50, $function = 'sqrt'),
        'compose' => $faker->name,
        'singer' => $faker->name,
        'genre' => $faker->name,
        'lyrics' => $faker->text,
    ];
});
