<?php

namespace App\Helpers\OneTimePassword\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OneTimePassword extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'one_time_passwords';

    protected $fillable = [
        'identifier', 'token', 'validity', 'expired', 'no_times_generated', 'generated_at',
    ];

    protected $casts = [
        // 'generated_at' => 'datetime',
    ];

    public function isExpired(): bool
    {
        if ($this->expired) {
            return true;
        }

        $generatedTime = $this->updated_at->addMinutes($this->validity);

        if (strtotime($generatedTime) >= strtotime(Carbon::now()->toDateTimeString())) {
            return false;
        }
        $this->expired = true;
        $this->save();

        return true;
    }

    public function expiredAt(): object
    {
        return $this->updated_at->addMinutes($this->validity);
    }
}
