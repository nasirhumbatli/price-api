<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'addresses' => 'required|array|min:2',
            'addresses.*.country' => 'required|string|exists:mongodb.cities,country',
            'addresses.*.zip' => 'required|string|exists:mongodb.cities,zipCode',
            'addresses.*.city' => 'required|string|exists:mongodb.cities,name',
        ];
    }
}
