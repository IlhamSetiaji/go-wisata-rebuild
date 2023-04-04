<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository{

    // Write something awesome :)
    public function findBy(string $field, string $value): ?object;
    public function whereHasRole(string $role): ?object;
    public function whereHasNotRole(string $role): ?object;
}
