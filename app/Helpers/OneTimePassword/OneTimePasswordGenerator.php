<?php

namespace App\Helpers\OneTimePassword;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Helpers\OneTimePassword\Model\OneTimePassword as OneTimePasswordModel;

class OneTimePasswordGenerator
{
    /**
     * Length of the generated OTP
     *
     * @var int
     */
    protected $length;

    /**
     * Generated OPT type
     *
     * @var bool
     */
    protected $onlyDigits;

    /**
     * use same token to resending opt
     *
     *  @var bool
     */
    protected $useSameToken;

    /**
     * Otp Validity time
     *
     * @var int
     */
    protected $validity;

    /**
     * Delete old otps
     *
     * @var int
     */
    protected $deleteOldOtps;

    /**
     * Maximum otps allowed to generate
     *
     *  @var int
     */
    protected $maximumOtpsAllowed;

    /**
     * Maximum number of times to allowed to validate
     *
     * @var int
     */
    protected $allowedAttempts;

    public function __construct()
    {
        $this->length = config('one-time-password.length');
        $this->onlyDigits = config('one-time-password.onlyDigits');
        $this->useSameToken = config('one-time-password.useSameToken');
        $this->validity = config('one-time-password.validity');
        $this->deleteOldOtps = config('one-time-password.deleteOldOtps');
        $this->maximumOtpsAllowed = config('one-time-password.maximumOtpsAllowed');
        $this->allowedAttempts = config('one-time-password.allowedAttempts');
    }

    /**
     * When a method is called, look for the 'set' prefix and attempt to set the
     * matching property to the value passed to the method and return a chainable
     * object to the caller.
     *
     * @param string $method
     * @param mixed $params
     * @return mixed
     */
    public function __call(string $method, $params)
    {
        if (substr($method, 0, 3) != 'set') {
            return;
        }

        $property = Str::camel(substr($method, 3));


        // Does the property exist on this object?
        if (!property_exists($this, $property)) {
            return;
        }

        $this->{$property} = $params[0] ?? null;

        return $this;
    }

    public function generate(string $identifier): object
    {
        $this->deleteOldOtps();

        $otp = OneTimePasswordModel::where('identifier', $identifier)->first();

        if ($otp == null) {
            $otp = OneTimePasswordModel::create([
                'identifier' => $identifier,
                'token' => $this->createPin(),
                'validity' => $this->validity,
                // 'generated_at' => Carbon::now(),
                // 'generated_at' => Carbon::now(),
            ]);
        } else {
            if ($otp->no_times_generated == $this->maximumOtpsAllowed) {
                return (object) [
                    'status' => false,
                    'message' => "Reached the maximum times to generate OTP",
                ];
            }

            $otp->update([
                'identifier' => $identifier,
                'token' => $this->useSameToken ? $otp->token : $this->createPin(),
                'validity' => $this->validity,
                // 'generated_at' => Carbon::now(),
            ]);
        }


        $otp->increment('no_times_generated');


        return (object) [
            'status' => true,
            'token' => $otp->token,
            'message' => "OTP generated",
        ];
    }

    public function validate(string $identifier, string $token): object
    {
        $otp = OneTimePasswordModel::where('identifier', $identifier)->first();

        if (!$otp) {
            return (object) [
                'status' => false,
                'message' => 'OTP does not exists, Please generate new OTP',
            ];
        }

        if ($otp->isExpired()) {
            return (object) [
                'status' => false,
                'message' => 'OTP is expired',
            ];
        }

        if ($otp->no_times_attempted == $this->allowedAttempts) {
            return (object) [
                'status' => false,
                'message' => "Reached the maximum allowed attempts",
            ];
        }

        $otp->increment('no_times_attempted');

        if ($otp->token == $token) {
            return (object) [
                'status' => true,
                'message' => 'OTP is valid',
            ];
        }

        return (object) [
            'status' => false,
            'message' => 'OTP does not match',
        ];
    }

    public function expiredAt(string $identifier): object
    {
        $otp = OneTimePasswordModel::where('identifier', $identifier)->first();

        if (!$otp) {
            return (object) [
                'status' => false,
                'message' => 'OTP does not exists, Please generate new OTP',
            ];
        }

        return (object) [
            'status' => true,
            'expired_at' => $otp->expiredAt(),
        ];
    }

    private function deleteOldOtps()
    {
        OneTimePasswordModel::where('expired', true)
            ->orWhere('created_at', '<', Carbon::now()->subMinutes($this->deleteOldOtps))
            ->delete();
    }

    private function createPin(): string
    {
        if ($this->onlyDigits) {
            $characters = '0123456789';
        } else {
            $characters = '123456789abcdefghABCDEFGH';
        }
        $length = strlen($characters);
        $pin = '';
        for ($i = 0; $i < $this->length; $i++) {
            $pin .= $characters[rand(0, $length - 1)];
        }

        return $pin;
    }
}
