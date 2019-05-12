<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Http\Requests\ArticleRequest;
use JWTAuth;
use App\Article;

class ArticleController extends Controller
{

    protected $articleRepo;


    public function __construct(ArticleRepositoryInterface $articleRepo) 
    {
        $this->articleRepo = $articleRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->articleRepo->get();

        return response()->json(compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $this->articleRepo->createOrUpdate($request->all(), $user);
        
        $action = $request->get('id') ? 'updated' : 'created';

        return response()->json(['success' => "Article {$action} successfully"]);
    }

    /**
     * .
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article = $article->load(['images','user']);

        return response()->json(compact('article'));
    }

    /**
     * .
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(['success' => 'Article removed successfully']);
    }
}
