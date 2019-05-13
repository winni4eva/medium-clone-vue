<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use DatabaseSeeder;
use Illuminate\Pagination\Paginator;
use App\User;
use App\Article;

class ArticleRepositoryTest extends TestCase
{

    use RefreshDatabase;

    protected $articleRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->articleRepo = app()->make(ArticleRepositoryInterface::class);
        $this->seed('DatabaseSeeder');
    }

    /**
     * Get articles.
     *
     * @test
     * @return void
     */
    public function can_get_all_article()
    {
        $articles = $this->articleRepo->get();
        
        $this->assertInstanceOf(Paginator::class, $articles);
        $this->assertEquals(3, $articles->count());
    }

    /**
     * Create article.
     *
     * @test
     * @return void
     */
    public function can_create_article()
    {
        $user = User::first();
        $article = $article = [
            'title'=> 'My First Article',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => []
        ];

        $this->articleRepo->createOrUpdate($article, $user);

        $this->assertDatabaseHas(
            'articles', [
                'title' => $article['title']
            ]
        );
    }

    /**
     * Update article.
     *
     * @test
     * @return void
     */
    public function can_update_article()
    {
        $user = User::first();
        $article = Article::first();
        $articleUpdateDetails = [
            'id' => $article->id,
            'title'=> 'My Second Article',
            'description' => 'Lets make the world a better place',
            'tags' => json_encode(['fiction', 'literature']),
            'images' => []
        ];

        $this->articleRepo->createOrUpdate($articleUpdateDetails, $user);

        $updatedArticle = Article::find($article->id);

        $this->assertEquals($articleUpdateDetails['title'], $updatedArticle->title);
    }
}
