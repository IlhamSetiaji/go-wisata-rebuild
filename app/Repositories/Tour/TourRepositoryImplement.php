<?php

namespace App\Repositories\Tour;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Tour;

class TourRepositoryImplement extends Eloquent implements TourRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Tour $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)

    public function paginateTours(int $perPage = 6): object
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findByAndPaginate(string $field, mixed $value, int $perPage = 6): object
    {
        return $this->model->where($field, $value)->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findBy(string $field, mixed $value): object
    {
        return $this->model->where($field, $value)->get();
    }
}
