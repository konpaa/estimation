<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Product\StoreRequest;
use App\Http\Requests\User\Product\UpdateRequest;
use App\Http\Resources\User\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(
            auth()->user()->products()->paginate()
        );
    }

    public function store(StoreRequest $request)
    {
        $product = $request->user()->products()->create($request->validated());

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $product->update($request->validated());

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product = auth()->user()->products()->findOrFail($product->id);
        $product->delete();

        return ['status' => 'success'];
    }
}
