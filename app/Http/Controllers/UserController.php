<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function storeLogin(LoginRequest $loginRequest)
    {
        if (!$this->userService->login($loginRequest->validated())) {
            return redirect()->back()->with($this->userService->getErrorType(), $this->userService->getErrorMessages());
        }
        return redirect('/')->with('success', 'Login successfully');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Logout successfully');
    }
}
