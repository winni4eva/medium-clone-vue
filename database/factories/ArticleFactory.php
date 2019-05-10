<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::first()->id ?? factory(User::class)->create()->id;
        },
        'title' => $faker->text,
        'description' => $faker->paragraph(5),
        'tags' => $faker->words
    ];
});
