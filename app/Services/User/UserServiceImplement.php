<?php

namespace App\Services\User;

use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends Service implements UserService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;
    protected $errorMessages;
    protected $errorType;

    public function __construct(UserRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getErrorMessages(): string
    {
        return $this->errorMessages;
    }

    public function getErrorType(): string
    {
        return $this->errorType;
    }

    // Define your custom methods :)

    public function login(array $data)
    {
        try{
            $user = $this->mainRepository->findBy('email', $data['email']);
            if ($user) {
                if (Hash::check($data['password'], $user->password)) {
                    Auth::login($user);
                    return true;
                } else {
                    $this->errorType = 'error';
                    $this->errorMessages = 'Credentials is incorrect';
                }
            } else {
                $this->errorType = 'error';
                $this->errorMessages = 'Credentials is incorrect';
            }
            return false;
        }catch (\Exception $exception){
            $this->errorType = 'error';
            $this->errorMessages = $exception->getMessage();
            return false;
        }
    }
}
