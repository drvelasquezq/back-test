<?php

use App\User;
use App\Models\Department;
use Faker\Generator as Faker;

$factory->define(App\Models\Destination::class, function (Faker $faker) {

    $department = Department::all()->random();
    $user = User::all()->random();

    return [
        'name' => $faker->unique()->name(),
        'sales_strategy' => $faker->paragraph(),
        'latitude' => $faker->randomFloat(6, -90, 90),
        'longitude' => $faker->randomFloat(6, -180, 180),
        'department_id' => $department->id,
        'user_id' => $user->id
    ];
});
