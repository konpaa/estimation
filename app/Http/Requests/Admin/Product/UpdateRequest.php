<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'price_currency' => Rule::in(config('products.supported_currencies')),
            'price' => 'numeric|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
