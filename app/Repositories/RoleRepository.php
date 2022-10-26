<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function list()
    {
        return $this->role->newQuery();
    }

    public function create($data)
    {
        $role = new $this->role;
        $role->name = $data['name'];
        $role->syncPermissions($data['permission']);
        $role->save();

        return $role;
    }

    public function get($model)
    {
        return $this->role->where('id', $model)->get();
    }

    public function modify($data, $model)
    {
        $role = new $this->role->find($model);
        $role->name = $data['name'];
        $role->syncPermissions($data['permission']);
        $role->update();

        return $role;
    }

    public function delete($model)
    {
        $role = $this->role->find($model);
        $role->delete();

        return $role;
    }
}
