<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'email' => 'string|email|unique:users,email,' . $this->route('user')->id,
            'role' => 'string|in:user,admin',
            'main_currency' => 'string|in:' . implode(',', config('currencies.supported_currencies')),
        ];
    }
}
