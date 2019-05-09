<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(App\Inquiry::class, function (Faker $faker) {
    $product_types = config('const.PRODUCT_A');
    $rand_key = array_rand($product_types);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'product_type' => $product_types[$rand_key],
        'content' => $faker->realText($faker->numberBetween(1, 2000)),
        'created_at' => $faker->dateTimeBetween(
            $startDate  = '-7 days', 
            $endDate    = 'now',
            $timezone   = 'Asia/Tokyo'
        ),
    ];
});
