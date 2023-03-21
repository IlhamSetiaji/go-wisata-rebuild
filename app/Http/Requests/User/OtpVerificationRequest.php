<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class OtpVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first' => 'required|numeric|digits:1',
            'second' => 'required|numeric|digits:1',
            'third' => 'required|numeric|digits:1',
            'fourth' => 'required|numeric|digits:1',
            'fifth' => 'required|numeric|digits:1',
            'sixth' => 'required|numeric|digits:1',
        ];
    }
}
