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

use App\Models\User;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'role' => $faker->randomElement([User::ADMIN_ROLE, User::PROFESSIONAL_ROLE])
    ];
});

$factory->define(App\Models\Clinic::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name . ' Lda'
    ];
});

$factory->define(App\Models\Patient::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'birthday' => $faker->date('Y-m-d', '-5 years'),
        'email' => $faker->email,
        'activated' => $faker->boolean()
    ];
});


$factory->define(App\Models\Rehabilitation::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(2),
        'started_at' => $faker->dateTimeBetween('+1 day', '+3 days'),
        'ended_at' => $faker->dateTimeBetween('+5 days', '+30 days'),
    ];
});
