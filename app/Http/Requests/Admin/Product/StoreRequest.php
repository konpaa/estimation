<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price_currency' => 'required|' . Rule::in(config('products.supported_currencies')),
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
