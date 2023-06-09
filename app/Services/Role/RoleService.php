<?php

namespace App\Services\Role;

use LaravelEasyRepository\BaseService;

interface RoleService extends BaseService{

    // Write something awesome :)
    public function getRolesWithUsers(): ?object;
    public function whereNotIn(string $field, array $values): ?object;
}
