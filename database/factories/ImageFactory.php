<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Image;
use App\Article;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'article_id' => function () {
            return Article::first()->id ?? factory(Article::class)->create()->id;
        },
        'image_path' => $faker->image(public_path('article_images'))
    ];
});
