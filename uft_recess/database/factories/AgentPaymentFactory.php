<?php

$factory->define(App\AgentPayment::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "highest_erollment" => $faker->randomNumber(2),
        "other_erollments" => $faker->randomNumber(2),
    ];
});
