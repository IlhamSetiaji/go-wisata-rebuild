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
}
