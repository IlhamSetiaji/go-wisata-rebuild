<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{

    public function getErrorMessages(): string;
    public function getErrorType(): string;
    // Write something awesome :)
    public function login(array $data);
    public function generateOtp(string $identifier);
    public function verifyOtp(string $identifier, string $token);
    public function sendOtpVerification(int $userId);
    public function resendOtp(int $userId);
    public function checkOtp(array $payload, int $userId);
    public function hideEmail(string $email);
    public function viewOtp(int $userId);
    public function register(array $payload);
    public function sendResetPassword(array $payload);
    public function resetPassword(array $payload);
    public function listAdmins(): ?object;
    public function getRolesExceptCurrent(string $role): ?object;
    public function getRolesExceptCurrentIn(string $field, array $roles): ?object;
    public function whereHasRoleIn(string $field, array $roles): ?object;
    public function storeAdmin(array $payload): ?object;
}
