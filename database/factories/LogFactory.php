<?php

use Faker\Generator as Faker;

$factory->define(App\Log::class, function (Faker $faker) {
    return [
        //
        'log_info' => $faker->asciify('*****'),
    ];
});
