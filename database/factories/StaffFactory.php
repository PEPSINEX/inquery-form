<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Staff::class, function (Faker $faker) {
    return [
        'name' => 'admin',
        'email' => 'admin@test.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'is_admin' => true
        // 'remember_token' => Str::random(10)
    ];
});
