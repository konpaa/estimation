<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Product\StoreRequest;
use App\Http\Requests\User\Product\UpdateRequest;
use App\Http\Resources\User\ProductResource;
use App\Models\Category;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index($categoryId)
    {
        return ProductResource::collection(
            auth()->user()->products()->where('category_id', $categoryId)->paginate()
        );
    }

    public function store(StoreRequest $request, $categoryId, ProductService $productService)
    {
        $product = $productService->create($categoryId, $request->getDto());

        $product->load('category');

        return new ProductResource($product);
    }

    public function show(Category $category, $productId)
    {
        $product = $category->products()->findOrFail($productId);
        $product->load('category');

        return new ProductResource($product);
    }

    public function update(UpdateRequest $request, $categoryId, $productId, ProductService $productService)
    {
        $product = $productService->update($request->getDto(), $categoryId, $productId);
        $product->load('category');

        return new ProductResource($product);
    }

    public function destroy($categoryId, $productId)
    {
        $product = request()->user()->products()->findOrFail($productId);
        $product->delete();

        return ['status' => 'success'];
    }
}
