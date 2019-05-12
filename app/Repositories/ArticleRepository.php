<?php
namespace App\Repositories;


use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Article;
use Illuminate\Pagination\Paginator;
use App\Image;
use App\User;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $model;

    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    /**
     * Get all films
     *
     * @return mixed
     */
    public function get($paginate = 10): Paginator
    {
        return $this->model->with(['images','user'])
            ->orderBy('created_at', 'desc')
            ->simplePaginate($paginate);
    }

    /**
     * Save film
     *
     * @return void
     */
    public function createOrUpdate(array $request, User $user): void
    {
        $article = $this->model->updateOrCreate(
            ['id' => $request['id'] ?? 0],
            [
                'user_id' => $user->id,
                'title' => $request['title'],
                'description' => $request['description'],
                'tags' => $request['tags']
            ]
        );
        if ($request['id'] > 0) {
            $article->images()->delete();
        }
        $articleImages = [];
        foreach ($request['images'] as $image) {
            $image_path = $image->store(
                'article_images', 
                ['disk' => 'public_uploads']
            );
            $articleImages[] = new Image(compact('image_path'));
        }

        $article->images()->saveMany($articleImages);
    }
}
