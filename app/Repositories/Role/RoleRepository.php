<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Repository;

interface RoleRepository extends Repository{

    // Write something awesome :)
    public function getRolesWithUsers(): ?object;
    public function whereNotIn(string $field, array $values): ?object;
}
