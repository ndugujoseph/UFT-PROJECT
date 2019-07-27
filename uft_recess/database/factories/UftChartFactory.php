<?php

$factory->define(App\UftChart::class, function (Faker\Generator $faker) {
    return [
        "reports" => $faker->name,
    ];
});
