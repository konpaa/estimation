<?php

namespace App\Http\Requests\User\Product;

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

    protected function passesAuthorization()
    {
        return auth()->user()->products->contains($this->route('product')->id);
    }
}
