<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\StoreAdminRequest;
use App\Http\Requests\User\UpdateAdminRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Http\Requests\User\OtpVerificationRequest;

class UserController extends Controller
{
    private $userService;
    private $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
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
        if (!$data) {
            return redirect()->back()->with($this->userService->getErrorType(), $this->userService->getErrorMessages());
        }
        return view('auth.otp', ['email' => $data['email'], 'userID' => $data['userID']]);
    }

    public function resendOtp(int $id)
    {
        if (!$this->userService->resendOtp($id)) {
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
        if (!$user) {
            return redirect()->back()->with($this->userService->getErrorType(), $this->userService->getErrorMessages());
        }
        return redirect('/otp/' . $user->id)->with('success', 'Register successfully, please check your email for verification');
    }

    public function sendResetPassword(ForgotPasswordRequest $request)
    {
        $payload = $request->validated();
        return $this->userService->sendResetPassword($payload);
    }

    public function resetPasswordView($token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $payload = $request->validated();
        return $this->userService->resetPassword($payload);
    }

    public function listAdmins()
    {
        try {
            $roles = $this->roleService->getRolesWithUsers();
            return view('admin.index', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function storeAdmin(StoreAdminRequest $request)
    {
        try {
            $payload = $request->validated();
            $user = $this->userService->storeAdmin($payload);
            $role = $this->roleService->find($payload['role_id']);
            $user->assignRole($role->name);
            return redirect()->back()->with('success', 'Admin created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateAdmin(UpdateAdminRequest $request, int $userId)
    {
        try {
            $payload = $request->validated();
            $user = $this->userService->updateAdmin($payload, $userId);
            if (!$user) {
                return redirect()->back()->with('error', 'Something went wrong');
            }
            return redirect()->back()->with('success', 'Admin updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function exportUsers()
    {
        try {
            return $this->userService->exportUsers();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
