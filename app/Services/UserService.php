<?php

namespace App\Services;

use App\Filters\Search;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Samushi\QueryFilter\Facade\QueryFilter;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function filters()
    {
        return [
            new Search(['name', 'email']),
        ];
    }

    public function list(int $count = 10)
    {
        return QueryFilter::query($this->userRepository->list(), $this->filters())
                                ->orderBy('id', 'desc')
                                ->paginate($count);
    }

    public function get($user)
    {
        return $this->userRepository->get($user);
    }

    public function modify($data, $model)
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->modify($data, $model);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update user data!');
        }
        DB::commit();

        return $user;
    }

    public function delete($model)
    {
        return $this->userRepository->delete($model);
    }
}
