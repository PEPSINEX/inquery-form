<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'content'       => $faker->realText($maxNbChars = 4000, $indexSize = 2),
        'staff_id'      => 2,
        'inquiry_id'    => function () {
            return factory(App\Inquiry::class)->make()->id;
        },
    ];
});
