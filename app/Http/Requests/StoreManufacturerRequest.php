<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManufacturerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'support_email' => 'required|email',
            'support_phone' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'support_url' => 'required|string|max:255',
            'warranty_lookup_url' => 'required|string|max:255',
        ];
    }
}
