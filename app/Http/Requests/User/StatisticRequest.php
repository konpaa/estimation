<?php

namespace App\Http\Requests\User;

use App\DataTransferObject\FilterProductDto;
use Illuminate\Foundation\Http\FormRequest;

class StatisticRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_at' => 'required|date|date_format:Y-m-d',
            'end_at' => 'required|date|date_format:Y-m-d',
            'category_name' => 'string|exists:categories,name'
        ];
    }

    public function getDto(): FilterProductDto
    {
        return new FilterProductDto(
            $this->get('start_at'),
            $this->get('end_at'),
            $this->get('category_name')
        );
    }
}
