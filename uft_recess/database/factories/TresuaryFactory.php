<?php

$factory->define(App\Tresuary::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "total" => $faker->randomNumber(2),
        "amount" => $faker->randomNumber(2),
    ];
});
