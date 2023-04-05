<?php

namespace App\Services\User;

use Exception;
use Carbon\Carbon;
use App\Mail\SendMessage;
use Illuminate\Support\Str;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Repositories\User\UserRepository;
use Illuminate\Auth\Events\PasswordReset;
use App\Helpers\OneTimePassword\OneTimePassword;

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
        try {
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
        } catch (\Exception $exception) {
            $this->errorType = 'error';
            $this->errorMessages = $exception->getMessage();
            return false;
        }
    }

    public function generateOtp(string $identifier)
    {
        try {
            $otp = OneTimePassword::setValidity(10)  // otp validity time in mins
                ->setLength(6)  // Length of the generated otp
                ->setMaximumOtpsAllowed(10) // Number of times allowed to regenerate otps
                ->setOnlyDigits(true)  // generated otp contains mixed characters ex:ad2312
                ->setUseSameToken(false) // if you re-generate OTP, you will get same token
                ->generate($identifier);
            // $verify = Otp::setAllowedAttempts(10) // number of times they can allow to attempt with wrong token
            //     ->validate($identifier, $otp->token);
            return $otp;
        } catch (Exception $err) {
            $this->errorType = 'error';
            $this->errorMessages = $err->getMessage();
            return false;
        }
    }

    public function verifyOtp($identifier, $token)
    {
        try {
            $verify = OneTimePassword::setAllowedAttempts(10) // number of times they can allow to attempt with wrong token
                ->validate($identifier, $token);
            return $verify;
        } catch (Exception $err) {
            $this->errorType = 'error';
            $this->errorMessages = $err->getMessage();
            return false;
        }
    }

    public function sendOtpVerification($userID)
    {
        try {
            $user = $this->mainRepository->find($userID);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
            if ($user->phone_verified_at != null) {
                return redirect()->back()->with('warning', 'Phone already verified');
            }
            $token = $this->generateOtp($user->email);
            return Mail::to($user->email)->send(new SendMessage($user->email, 'Your OTP token : ' . $token->token  . ' | Access link : ' . url('/otp/' . $user->id)));
        } catch (Exception $err) {
            $this->errorType = 'error';
            $this->errorMessages = $err->getMessage();
            return false;
        }
    }

    public function resendOtp($userID)
    {
        try {
            $user = $this->mainRepository->find($userID);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
            if ($user->phone_verified_at != null) {
                return redirect()->back()->with('warning', 'Phone already verified');
            }
            $token = $this->generateOtp($user->email);
            Mail::to($user->email)->send(new SendMessage($user->email, 'Your OTP token : ' . $token->token . ' | Access link : ' . url('/otp/' . $user->id)));
            return true;
        } catch (Exception $err) {
            $this->errorType = 'error';
            $this->errorMessages = $err->getMessage();
            return false;
        }
    }

    public function checkOtp($payload, $userID)
    {
        try {
            $otp = '';
            foreach ($payload as $key => $item) {
                $otp .= $item;
            }
            rtrim($otp, ',');
            $user = $this->mainRepository->find($userID);
            if (!$user) {
                $this->errorType = 'error';
                $this->errorMessages = 'User not found';
                return false;
            }
            $verify = $this->verifyOtp($user->email, $otp);
            if ($verify->status == false) {
                $this->errorType = 'error';
                $this->errorMessages = $verify->message;
                return false;
            }
            $user->email_verified_at = Carbon::now();
            $user->save();
            return true;
        } catch (Exception $err) {
            $this->errorType = 'error';
            $this->errorMessages = $err->getMessage();
            return false;
        }
    }

    public function hideEmail($email)
    {
        $email = explode('@', $email);
        $email[0] = substr($email[0], 0, 3) . '****';
        return implode('@', $email);
    }

    public function viewOtp($userID)
    {
        $user = $this->mainRepository->find($userID);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        if ($user->phone_verified_at != null) {
            return redirect()->back()->with('warning', 'Phone already verified');
        }
        $email = $this->hideEmail($user->email);
        $userID = $user->id;
        return [
            'email' => $email,
            'userID' => $userID
        ];
    }

    public function register(array $payload)
    {
        try {
            $payload['password'] = Hash::make($payload['password']);
            $user = $this->mainRepository->create($payload);
            $user->assignRole('pelanggan');
            $this->sendOtpVerification($user->id);
            return $user;
        } catch (Exception $err) {
            $this->errorType = 'error';
            $this->errorMessages = $err->getMessage();
            return false;
        }
    }

    public function sendResetPassword(array $payload)
    {
        try {
            $user = $this->mainRepository->findBy('email',$payload['email']);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
            $status = Password::sendResetLink(
                request()->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function resetPassword($payload)
    {
        try {
            $user = $this->mainRepository->findBy('email', $payload['email']);
            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }
            $status = Password::reset(
                request()->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }

    public function listAdmins(): ?object
    {
        return $this->mainRepository->whereHasNotRole('admin');
    }

    public function getRolesExceptCurrent(string $role): ?object
    {
        return $this->mainRepository->whereHasNotRole($role);
    }

    public function getRolesExceptCurrentIn(string $field, array $roles): ?object
    {
        return $this->mainRepository->whereHasNotRoleIn($field, $roles);
    }

    public function whereHasRoleIn(string $field, array $roles): ?object
    {
        return $this->mainRepository->whereHasRoleIn($field, $roles);
    }

    public function storeAdmin(array $payload): ?object
    {
        $payload['password'] = Hash::make($payload['password']);
        $user = $this->mainRepository->create($payload);
        return $user;
    }
}
