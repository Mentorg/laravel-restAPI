<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * @var roleService
     */
    protected $roleService;

    /**
     * RoleController constructor
     *
     * @param RoleService $roleService
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $this->authorize('list: role');
        return response()->json($this->roleService->list());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRoleRequest $request
     * @return JsonResponse
     */
    public function store(CreateRoleRequest $request)
    {
        $this->authorize('create: role');
        return response()->json($this->roleService->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Role $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        $this->authorize('read: role');
        return response()->json($this->roleService->get($role->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRoleRequest $request
     * @param  Role $role
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->authorize('update: role');
        return response()->json($this->roleService->modify($request->validated(), $role->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete: role');
        return response()->json($this->roleService->delete($role->id));
    }
}
