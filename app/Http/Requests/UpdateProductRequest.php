<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'product_name' => 'required|string|max:255',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'category_id' => 'required|exists:categories,id',
            'type' => 'nullable|string|max:255',
            'support_expire_date' => 'required|date',
            'purchase_date' => 'required|date',
            'cost' => 'required|integer'
        ];
    }
}
