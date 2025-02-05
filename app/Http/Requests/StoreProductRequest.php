<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'nullable|exists:manufacturers,id',
            'product_name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'support_expire_date' => 'required|date',
            'purchase_date' => 'required|date',
            'cost' => 'required|integer'
        ];
    }
}
