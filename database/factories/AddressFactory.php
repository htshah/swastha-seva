<?php

use Faker\Generator as Faker;

$factory->define(\App\Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetAddress,
        'city'=>'Mumbai',
        'state'=>'Maharashtra',
        'pincode'=> mt_rand(400001,400096),
    ];
});
