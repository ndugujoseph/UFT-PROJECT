<?php

$factory->define(App\AgentHeadPayment::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "highest_erollment" => $faker->randomNumber(2),
        "lowest_erollment" => $faker->randomNumber(2),
    ];
});
