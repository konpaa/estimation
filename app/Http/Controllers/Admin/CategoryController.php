<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(
            Category::paginate()
        );
    }

    public function store(StoreRequest $request)
    {
        $category = Category::create($request->validated());

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->validated());
        $category->refresh();

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        if ($category->products->isNotEmpty()) {
            throw ValidationException::withMessages(['message' => 'Category have products']);
        }
        $category->delete();

        return ['status' => 'success'];
    }
}
