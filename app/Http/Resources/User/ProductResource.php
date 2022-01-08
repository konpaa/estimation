<?php

namespace App\Http\Resources\User;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ProductResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category' => $this->whenLoaded('category', new CategoryResource($this->category)),
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price->getValue(),
            'price_currency' => $this->price->getCurrency(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
