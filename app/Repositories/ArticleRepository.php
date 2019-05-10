<?php
namespace App\Repositories;


use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Article;
use Illuminate\Pagination\Paginator;

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
}
