<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Http\Requests\ArticleRequest;

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
        logger($request->all());

        foreach ($request->images as $image) {
            $filename = $image->store('article_images');
            logger($filename);
            // ProductsPhoto::create([
            //     'product_id' => $product->id,
            //     'filename' => $filename
            // ]);
        }

        return response()->json(['success'=>'Article created successfully']);
    }
}
