<?php

namespace App\Repositories\Tour;

use LaravelEasyRepository\Repository;

interface TourRepository extends Repository{

    // Write something awesome :)

    public function paginateTours(int $perPage = 6);
    public function findByAndPaginate(string $field, mixed $value, int $perPage = 6);
    public function findBy(string $field, mixed $value);
}
