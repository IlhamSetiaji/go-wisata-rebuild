<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    public function getErrorMessages(): string;
    public function getErrorType(): string;
    // Write something awesome :)
    public function login(array $data);
}
