<?php

use Faker\Generator as Faker;
use App\Product;

$factory->define(App\Inquiry::class, function (Faker $faker) {
    $product_types = Product::getTypes();
    $rand_key = array_rand($product_types);
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'product_type' => $product_types[$rand_key],
        'content' => str_repeat('a', 2000),
    ];
});
