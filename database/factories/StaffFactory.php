<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Staff::class, function (Faker $faker) {
    return [
        'name' => 'test1',
        'email' => 'test1@test.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password')
        // 'remember_token' => Str::random(10)
    ];
});
