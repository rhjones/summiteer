<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Hike::class, function (Faker\Generator $faker) {
    return [
        'date_hiked' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'mileage' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1.0, $max = 150.00),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'notes' => $faker->text($maxNbChars = 200),
        'public' => $faker->boolean($chanceOfGettingTrue = 50),
        'user_id' => $faker->numberBetween($min = 1, $max = 4),
    ];
});
