<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Album::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'singer' => $faker->name,
        'description' => $faker->paragraph,
        'year' => $faker->year($max = 'now'),
        'image' => $faker->text,
        'user_id' => function(){
        	return App\User::all()->random();
        },
    ];
});
