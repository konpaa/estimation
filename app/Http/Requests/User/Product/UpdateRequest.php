<?php

namespace App\Http\Requests\User\Product;

use App\DataTransferObject\ProductDto;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string',
            'description' => 'string',
            'price_currency' => Rule::in(config('currencies.supported_currencies')),
            'price' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'created_at' => 'date',
        ];
    }

    protected function passesAuthorization()
    {
        return $this->user()->products->contains($this->route('product'));
    }

    public function getDto(): ProductDto
    {
        return new ProductDto(
            $this->get('name'),
            $this->get('description'),
            $this->user()->id,
            $this->get('price_currency'),
            $this->get('price'),
            $this->route('category'),
            $this->get('created_at')
        );
    }
}
