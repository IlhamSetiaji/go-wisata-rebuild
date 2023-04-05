<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $userService;
    private $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function fetchRoles(Request $request)
    {
        $role = $this->roleService->find($request->role_id);
        switch($role->id){
            case 2:
                $roles = $this->userService->whereHasRoleIn('id', [1]);
                break;
            case 3:
                $roles = $this->userService->whereHasRoleIn('id', [1, 2]);
                break;
            case 4:
                $roles = $this->userService->whereHasRoleIn('id', [1, 3]);
                break;
            case 5:
                $roles = $this->userService->whereHasRoleIn('id', [1, 3]);
                break;
            default:
                $roles = $this->userService->whereHasRoleIn('id', [1, 2, 3]);
                break;
        }
        return response()->json($roles);
    }
}
