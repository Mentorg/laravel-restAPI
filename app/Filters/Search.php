<?php

namespace App\Filters;
use Samushi\QueryFilter\Filter;

class Search extends Filter
{
    private $search;

    public function __construct(array $search = ['query'])
    {
        $this->search = $search;
    }

    /**
     * Search Result by whereLike
     * @param $builder
     * @return mixed
     */
    protected function applyFilter($builder)
    {
        return $builder->whereLike($this->search, request()->get($this->fillterName()));
    }
}
