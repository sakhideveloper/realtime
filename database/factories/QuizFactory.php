<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Quiz;
use Faker\Generator as Faker;

$factory->define(Quiz::class, function (Faker $faker) {
    return [
        'quiz_hash' => Illuminate\Support\Str::uuid(),
		'quiz_title' => $faker->name,
		'quiz_slug' => $faker->slug,
		'status' => rand(0,1),
    ];
});
