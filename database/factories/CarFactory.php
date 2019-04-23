<?php

use Faker\Generator as Faker;

$factory->define(App\Car::class, function (Faker $faker) {
    return [
        'user_id' => function(){
        return \App\user::all()->random();
        },
        'licence_plate' => $faker->regexify('[0-9]{2}[-][A-Z]{2}[-][0-9]{3}'),
        'color' => $faker->name,
        'model' => $faker->name,
    ];
});
