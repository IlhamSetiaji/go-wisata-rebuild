<?php

namespace App\Repositories\Role;

use Spatie\Permission\Models\Role;
use LaravelEasyRepository\Implementations\Eloquent;

class RoleRepositoryImplement extends Eloquent implements RoleRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function getRolesWithUsers(): ?object
    {
        return $this->model->with('users','users.parent')->whereNot('id',1)->get();
    }

    public function whereNotIn(string $field, array $values): ?object
    {
        return $this->model->whereNotIn($field, $values)->get();
    }
}
