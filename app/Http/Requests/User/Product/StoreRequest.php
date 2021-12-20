<?php

namespace App\Http\Requests\User\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'currency' => 'required|in:BYN,USD,EUR',
            'value' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }
}
