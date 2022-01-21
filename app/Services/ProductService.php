<?php

namespace App\Services;

use App\DataTransferObject\ProductDto;
use App\Models\Category;
use App\Models\Product;

class ProductService
{
    public function create($categoryId, ProductDto $request)
    {
        Category::findOrFail($categoryId);

        return Product::create($this->transformDTOToArray($request));
    }

    public function update(ProductDto $request, $categoryId, $productId)
    {
        $product = Category::find($categoryId)->products()->findOrFail($productId);

        $product->update($this->transformDTOToArray($request));

        $product->fresh();

        return $product;
    }

    private function transformDTOToArray(ProductDto $productDto): array
    {
        $arrayProduct = [
            'name' => $productDto->getName(),
            'description' => $productDto->getDescription(),
            'price' => $productDto->getPrice(),
            'price_currency' => $productDto->getPriceCurrency(),
            'user_id' => $productDto->getUserId(),
            'category_id' => $productDto->getCategoryId(),
            'created_at' => $productDto->getCreatedAt(),
        ];

        return array_filter($arrayProduct, fn($productOption) => $productOption != null);
    }
}
