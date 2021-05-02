<?php

use App\User;
use App\Models\Region;
use Faker\Generator as Faker;

$factory->define(App\Models\Department::class, function (Faker $faker) {

    $region = Region::all()->random();
    $user = User::all()->random();

    return [
        'name' => $faker->unique()->name(),
        'region_id' => $region->id,
        'user_id' => $user->id
    ];
});
