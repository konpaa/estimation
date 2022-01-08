<?php

namespace App\Http\Requests\User\Product;

use App\DataTransferObject\ProductDto;
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

    public function getDto(): ProductDto
    {
        return new ProductDto(
            $this->get('name'),
            $this->get('description'),
            $this->user()->id,
            $this->get('price_currency'),
            $this->get('price'),
            $this->route('category')
        );
    }
}
