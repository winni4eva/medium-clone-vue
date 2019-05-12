<?php

namespace App\Repositories\Interfaces;

use App\Film;
use Illuminate\Pagination\Paginator;
use App\User;

interface ArticleRepositoryInterface
{

    /**
     * Get all films
     *
     * @return mixed
     */
    public function get($paginate = 10): Paginator;

    /**
     * Save film
     *
     * @return void
     */
    public function save(array $request, User $user): void;
}