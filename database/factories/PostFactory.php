<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'         => $faker->words(3, true),
        'description'   => $faker->text(),
        'user_id'       => function () {
            return factory(\App\User::class)->create()->id;
        },
    ];
});
