<?php

namespace App\Services;

use App\Filters\Search;
use App\Repositories\ArticleRepository;
use Samushi\QueryFilter\Facade\QueryFilter;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function filters()
    {
        return [
            new Search(['title', 'content']),
        ];
    }

    public function list(int $count = 10)
    {
        return QueryFilter::query($this->articleRepository->list(), $this->filters())
                                ->orderBy('id', 'desc')
                                ->paginate($count);
    }

    public function create(array $data)
    {
        return $this->articleRepository->create($data);
    }

    public function get($model)
    {
        return $this->articleRepository->get($model);
    }

    public function modify($data, $model)
    {
        return $this->articleRepository->modify($data, $model);
    }

    public function delete($model)
    {
        return $this->articleRepository->delete($model);
    }
}
