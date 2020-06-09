<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Note;
use Faker\Generator as Faker;

$factory->define(Note::class, function (Faker $faker) {
    $user_id = $faker->numberBetween(1, 30);
    $evaluation = $faker->randomFloat(1,1,5);

    return [
        'user_id'    => $user_id,
        'title'      => $faker->title(),
        'comment'    => $faker->realText(20),
        'url'        => $faker->url(),
        'evaluation' => $evaluation,
];
});
