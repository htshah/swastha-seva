<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(\App\Users::class, function (Faker $faker) {
    return [
        'name'   => $faker->name,
        'mobile' => $faker->e164PhoneNumber,
        'email'  => $faker->safeEmail,
        'aadhar' => substr($faker->e164PhoneNumber, 2),
        'dob'    => $faker->date('Y-m-d'),
    ];
});
