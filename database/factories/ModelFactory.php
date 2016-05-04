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
use Illuminate\Support\Facades\Hash;

$factory->define(App\User::class, function ($faker) {
    return [
        'Email' => $faker->email,
        'Password' => Hash::make('@drftgy'),
        'Type' => 'user'
    ];
});

$factory->define(App\Models\UserMeta::class, function ($faker) {
    return [
        'FirstName' => $faker->firstName,
        'LastName' => $faker->lastName,
        'BirthDate' => $faker->date($format = 'Y-m-d', $max = '1990-1-1')
    ];
});
