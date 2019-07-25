<?php

$factory->define(App\Members::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "district" => $faker->name,
        "recommender_agent" => $faker->name,
        "recommender_member" => $faker->name,
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "member_id" => $faker->name,
        "gender" => $faker->name,
        "recommendees" => $faker->randomNumber(2),
    ];
});
