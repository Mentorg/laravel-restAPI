<?php

namespace App\Services;

use App\Filters\Search;
use App\Repositories\RoleRepository;
use Samushi\QueryFilter\Facade\QueryFilter;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function filters()
    {
        return [
            new Search(['name']),
        ];
    }

    public function list(int $count = 10)
    {
        return QueryFilter::query($this->roleRepository->list(), $this->filters())
                                ->orderBy('id', 'desc')
                                ->paginate($count);
    }

    public function create(array $data)
    {
        return $this->roleRepository->create($data);
    }

    public function get($model)
    {
        return $this->roleRepository->get($model);
    }

    public function modify($data, $model)
    {
        return $this->roleRepository->modify($data, $model);
    }

    public function delete($model)
    {
        return $this->roleRepository->delete($model);
    }
}
