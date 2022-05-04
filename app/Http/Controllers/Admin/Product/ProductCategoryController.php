<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Product\ProductCategoryRequest;
use App\Models\Product\ProductCategory as Category;
use App\Presenters\Admin\Product\CategoryProductPresenter;


class ProductCategoryController extends Controller
{

    public function index()
    {
        return view('admin.product-category.list', [
            'items' => CategoryProductPresenter::items()
        ]);
    }

    public function store(ProductCategoryRequest $request)
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    public function edit(Category $category)
    {
        return response()->json([
            'success' => 1,
            'item' => CategoryProductPresenter::edit($category)
        ]);
    }

    public function update(ProductCategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();

        session()->flash('success', 'Success!');

        return response()->json([
            'success' => 1
        ]);
    }

    public function destroy(Category $category)
    {
        $isDeleted = $category->delete() === true;
        $isDeleted ? session()->flash('success', 'Success!') :
            session()->flash('mistakes', ['Deletion error']);

        return response()->json([
            'success' => 1
        ]);
    }
}
