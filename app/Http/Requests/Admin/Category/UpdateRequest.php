<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|unique:categories,name,' . $this->category->id,
            'description' => 'string'
        ];
    }
}
