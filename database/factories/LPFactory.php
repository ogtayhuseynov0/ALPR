<?php

use Faker\Generator as Faker;

$factory->define(App\Model\LP::class, function (Faker $faker) {
    return [
        'lplate' => $faker->regexify('[0-9]{2}[-][A-Z]{2}[-][0-9]{3}')
    ];
});
