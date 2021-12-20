<?php

namespace App\Http\Requests\User\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'currency' => 'in:BYN,USD,EUR',
            'value' => 'numeric|regex:/^\d+(\.\d{1,2})?$/'
        ];
    }

    protected function passesAuthorization()
    {
        return auth()->user()->products->contains($this->route('product')->id);
    }
}
