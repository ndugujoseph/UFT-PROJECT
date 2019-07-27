<?php

$factory->define(App\Districts::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "initials" => $faker->name,
        "region" => $faker->name,
        "agent_head" => $faker->name,
        "agents" => $faker->name,
        "members" => $faker->name,
    ];
});
