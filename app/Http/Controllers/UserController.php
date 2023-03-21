<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\OtpVerificationRequest;
use App\Http\Requests\User\RegisterRequest;
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

    public function verifyOtp(OtpVerificationRequest $otpVerificationRequest)
    {
        $payload = $otpVerificationRequest->validated();
        $userId = request()->route('id');
        if (!$this->userService->checkOtp($payload, $userId)) {
            return redirect()->back()->with($this->userService->getErrorType(), $this->userService->getErrorMessages());
        }
        return redirect('/')->with('success', 'Otp verified successfully');
    }

    public function showVerifyOtp(int $id): View
    {
        $data = $this->userService->viewOtp($id);
        if(!$data){
            return redirect()->back()->with($this->userService->getErrorType(), $this->userService->getErrorMessages());
        }
        return view('auth.otp', ['email' => $data['email'], 'userID' => $data['userID']]);
    }

    public function resendOtp(int $id)
    {
        if(!$this->userService->resendOtp($id)){
            return redirect()->back()->with($this->userService->getErrorType(), $this->userService->getErrorMessages());
        }
        return redirect()->back()->with('success', 'Otp resend successfully');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function storeRegister(RegisterRequest $registerRequest)
    {
        $payload = $registerRequest->validated();
        $user = $this->userService->register($payload);
        if(!$user){
            return redirect()->back()->with($this->userService->getErrorType(), $this->userService->getErrorMessages());
        }
        return redirect('/otp/'.$user->id)->with('success', 'Register successfully, please check your email for verification');
    }
}
