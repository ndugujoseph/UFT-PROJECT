<?php

$factory->define(App\AdminPayment::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "amount" => $faker->randomNumber(2),
    ];
});
