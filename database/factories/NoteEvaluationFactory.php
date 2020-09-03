<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NoteEvaluation;
use Faker\Generator as Faker;

$factory->define(NoteEvaluation::class, function (Faker $faker) {
    $user_id = $faker->numberBetween(1,3);
    $note_id = $faker->numberBetween(1,50);
    $evaluation = $faker->randomFloat(1,1,5);

    return [
        'user_id'    => $user_id,
        'note_id'    => $note_id,
        'evaluation' => $evaluation,
        'comment'    => $faker->realText(20),
];
});
