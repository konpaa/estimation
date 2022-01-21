<?php

namespace App\Http\Requests\Admin\Product;

use App\DataTransferObject\ProductDto;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price_currency' => 'required|' . Rule::in(config('currencies.supported_currencies')),
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'created_at' => 'date'
        ];
    }

    public function getDto(): ProductDto
    {
        return new ProductDto(
            $this->get('name'),
            $this->get('description'),
            $this->route('user'),
            $this->get('price_currency'),
            $this->get('price'),
            $this->route('category'),
            $this->get('created_at'),
        );
    }
}
