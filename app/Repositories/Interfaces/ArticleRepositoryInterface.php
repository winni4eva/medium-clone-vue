<?php

namespace App\Repositories\Interfaces;

use App\Film;
use Illuminate\Pagination\Paginator;

interface ArticleRepositoryInterface
{

    /**
     * Get all films
     *
     * @return mixed
     */
    public function get($paginate = 10): Paginator;
}