<?php

namespace App\Helpers\OneTimePassword;

use Illuminate\Support\Facades\Facade;

class OneTimePassword extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'one-time-password';
    }
}
