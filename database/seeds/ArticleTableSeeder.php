<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\Image;
use App\User;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 3)
            ->create(
                [
                    'user_id' => User::first()->id
                ]
            )
            ->each( 
                function (Article $article) {
                    factory(Image::class, 2)
                        ->create(
                            [
                                'article_id' => $article->id,
                            ]
                        );
                }
            );
    }
}
