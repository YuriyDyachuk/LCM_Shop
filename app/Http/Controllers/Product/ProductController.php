<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Presenters\Product\ProductCategoryPresenter;

class ProductController extends Controller
{
    public function allProduct()
    {
        $items = ProductCategoryPresenter::items(
            Product::active()->orderBy('name')
            ->get()
        );

        return view('product.category', [
            'items' => $items,
            'pageTitle' => 'All Items',
        ]);
    }

    public function category($categoryId)
    {
        $category = ProductCategory::findOrFail($categoryId);
        $items = ProductCategoryPresenter::items(
            $category->products()
                ->active()
                ->orderBy('name')
                ->get()
        );

        return view('product.category', [
            'items' => $items,
            'pageTitle' => $category->name,
        ]);
    }

    public function detail($productId)
    {
        /**
         * @var Product $product
         */
        $product = Product::findOrFail($productId);

        return view('product.detail', [
            'item' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'description' => $product->description
            ],
            'category' => [
                'name' => $product->category->name,
                'url' => route('product.category', ['category' => $product->category->id])
            ],
            'pageTitle' => $product->name,
        ]);
    }
}
