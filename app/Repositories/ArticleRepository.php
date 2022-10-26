<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function list()
    {
        return $this->article->newQuery();
    }

    public function create($data)
    {
        $article = new $this->article;
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->save();

        return $article->fresh();
    }

    public function get($model)
    {
        return $this->article->where('id', $model)->get();
    }

    public function modify($data, $model)
    {
        $article = $this->article->find($model);
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->update();

        return $article;
    }

    public function delete($model)
    {
        $article = $this->article->find($model);
        $article->delete();

        return $article;
    }
}
