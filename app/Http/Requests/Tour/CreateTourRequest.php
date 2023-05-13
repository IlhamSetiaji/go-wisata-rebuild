<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class CreateTourRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'province_id' => 'required',
            'district_id' => 'required',
            'sub_district_id' => 'required',
            'city_id' => 'required',
            'province_name' => 'required|string',
            'district_name' => 'required|string',
            'sub_district_name' => 'required|string',
            'city_name' => 'required|string',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'address' => 'required|string',
            'postal_code' => 'required|string',
            'phone' => 'required|string',
        ];
    }
}
