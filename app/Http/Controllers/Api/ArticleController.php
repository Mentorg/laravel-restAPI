<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * @var $articleService
     */
    protected $articleService;

    /**
     * ArticleController constructor
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $this->authorize('list: article');
        return response()->json($this->articleService->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateArticleRequest $request
     * @return JsonResponse
     */
    public function store(CreateArticleRequest $request)
    {
        $this->authorize('create: article');
        return response()->json($this->articleService->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return JsonResponse
     */
    public function show(Article $article)
    {
        $this->authorize('read: article');
        return response()->json($this->articleService->get($article->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateArticleRequest $request
     * @param  Article $article
     * @return JsonResponse
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update: article');
        return response()->json($this->articleService->modify($request->validated(), $article->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return JsonResponse
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete: article');
        return response()->json($this->articleService->delete($article->id));
    }
}
