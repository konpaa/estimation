<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Resources\User\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(User $user, $categoryId)
    {
        return ProductResource::collection($user->products()->where('category_id', $categoryId)->paginate());
    }

    public function store(StoreRequest $request, $userId, $categoryId, ProductService $productService)
    {
        $product = $productService->create($categoryId, $request->getDto());
        $product->load('category');

        return new ProductResource($product);
    }

    public function show(User $user, Category $category, $productId)
    {
        return new ProductResource($user->products()->findOrFail(
            $category->products()->findOrFail($productId)->id
        ));
    }

    public function update(UpdateRequest $request, $userId, $categoryId, $productId, ProductService $productService)
    {
        $product = $productService->update($request->getDto(), $categoryId, $productId);
        $product->load('category');

        return new ProductResource($product);
    }

    public function destroy(User $user, Category $category, $productId)
    {
        $user->products()->findOrFail(
            $category->products()->with('category')->findOrFail($productId)->id
        )->delete();

        return ['status' => 'success'];
    }
}
