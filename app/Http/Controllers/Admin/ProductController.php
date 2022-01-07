<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Resources\User\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(User $user)
    {
        return ProductResource::collection($user->products()->paginate());
    }

    public function store(StoreRequest $request, User $user)
    {
        $product = $user->products()->create($request->validated());

        return new ProductResource($product);
    }

    public function show(User $user, Product $product)
    {
        return new ProductResource($user->products()->findOrFail($product->id));
    }

    public function update(UpdateRequest $request, User $user, Product $product)
    {
        $user->products()->findOrFail($product->id)->update($request->validated());
        $product->refresh();

        return new ProductResource($product);
    }

    public function destroy(User $user, Product $product)
    {
        $user->products()->findOrFail($product->id)->delete();

        return ['status' => 'success'];
    }
}
