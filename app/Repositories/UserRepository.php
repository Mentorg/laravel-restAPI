<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function list()
    {
        return $this->user->newQuery();
    }

    public function get($user)
    {
        return $this->user->where('id', $user)->get();
    }

    public function modify($data, $model)
    {
        $user = $this->user->find($model);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->update();

        return $user;
    }

    public function delete($model)
    {
        $user = $this->user->find($model);
        $user->delete();

        return $user;
    }
}
