<?php

$factory->define(App\WellWishers::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "amount" => $faker->randomFloat(2, 1, 100),
        "district_id" => factory('App\Districts')->create(),
    ];
});
