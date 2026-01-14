<?php

use Carbon\Carbon;

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

// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'email' => $faker->safeEmail,
//         'password' => bcrypt(str_random(10)),
//         'remember_token' => str_random(10),
//     ];
// });



$factory->define(App\Reservation::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create("sv_SE");

    // Skapar bara bokningar nuvarande år
    // $year   = Carbon::now()->year;

    // Skapar bokningar från nuvarande år till och med 3 år gammalt
    // $year   = Carbon::now()->subYears(rand(0,3))->year;
    
    // Skapar bokningar för alla år från 2016 till nuvarande år (för testning)
    $startYear = 2016;
    $currentYear = Carbon::now()->year;
    $year = rand($startYear, $currentYear);

    $start  = Carbon::create($year, rand(1, 12), rand(1, 28), rand(1, 24));
    $stop   = clone $start;

    return [
        'start' => $start,
        'stop'  => $stop->addHours(rand(1,4)),
        'name'  => $faker->name,
        'created_at' => $start->subHours(2),
        'updated_at' => $start->subHours(2),
    ];
});
