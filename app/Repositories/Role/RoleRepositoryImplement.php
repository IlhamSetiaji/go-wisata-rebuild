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
        return $this->model->with('users')->whereNot('id',1)->get();
    }
}
