<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Models\Region::class, function (Faker $faker) {

    $user = User::all()->random();

    return [
        'name' => $faker->unique()->name(),
        'user_id' => $user->id
    ];
});
