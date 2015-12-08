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
    $hike_notes = [
        'Awesome trail.',
        'Loved the view!',
        'Super challenging.',
        'Great day for a hike!',
        'Watch out for the rocky footing.',
        'Wish I\'d brought more water!',
        'Glad I brought my poles.',
        'Best summit yet!',
        'Weather was beautiful.',
    ];

    $hike_note = $hike_notes[rand(0, (count($hike_notes) - 1))];
    return [
        //'date_hiked' => $faker->date($format = 'Y-m-d', $min = '2013-01-01', $max = 'now'),
        'date_hiked' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now'),
        'mileage' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1.0, $max = 15.0),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'notes' => $hike_note,
        'public' => $faker->boolean($chanceOfGettingTrue = 50),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
