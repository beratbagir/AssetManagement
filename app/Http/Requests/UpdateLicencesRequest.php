<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLicencesRequest extends FormRequest
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
            'product_id' => 'required|exists:products,product_id',
            'licence_key' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'supplier_id' => 'nullable|exists:suppliers,supplier_id',
            'cost' => 'required|integer',
            'status' => 'required|string|max:255',
        ];
    }
}
