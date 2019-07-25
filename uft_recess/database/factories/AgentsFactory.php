<?php

$factory->define(App\Agents::class, function (Faker\Generator $faker) {
    return [
        "full_name" => $faker->name,
        "username" => $faker->name,
        "date_of_birth" => $faker->date("d-m-Y", $max = 'now'),
        "email" => $faker->safeEmail,
        "gender" => $faker->name,
        "role_id" => factory('App\Role')->create(),
        "district_id" => factory('App\Districts')->create(),
        "signature" => $faker->name,
        "password" => str_random(10),
    ];
});
