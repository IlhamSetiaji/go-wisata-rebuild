<?php

namespace App\Repositories\User;

use App\Models\User;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function findBy(string $field, string $value): ?object
    {
        return $this->model->where($field, $value)->first();
    }

    public function whereHasRole(string $role): ?object
    {
        return $this->model->with('roles')->whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        })->get();
    }

    public function whereHasRoleIn(string $field, array $roles): ?object
    {
        return $this->model->with('roles')->whereHas('roles', function ($query) use ($field, $roles) {
            $query->whereIn($field, $roles);
        })->get();
    }

    public function whereHasNotRole(string $role): ?object
    {
        return $this->model->with('roles')->whereDoesntHave('roles', function ($query) use ($role) {
            $query->where('name', $role);
        })->get();
    }

    public function whereHasNotRoleIn(string $field, array $roles): ?object
    {
        return $this->model->with('roles')->whereDoesntHave('roles', function ($query) use ($field, $roles) {
            $query->whereIn($field, $roles);
        })->get();
    }
}
