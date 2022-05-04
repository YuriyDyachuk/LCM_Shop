<?php

namespace App\Presenters\Admin\Product;

use App\Models\Product\ProductCategory;

class CategoryProductPresenter
{
    public static function items(): array
    {
        return ProductCategory::orderBy('name')
            ->with('products')
            ->get()
            ->map(function (ProductCategory $item) {
                $productCount = $item->products->count();
                if ($productCount <= 0)
                {
                    $productCount = '';
                }

                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'isActive' => $item->is_active,
                    'isActiveName' => $item->isActiveName,
                    'createdAt' => $item->created_at->toDateString(),
                    'productCount' => $productCount
                ];
            })->toArray();

    }

    public static function edit(ProductCategory $category): array
    {
        return [
            'name' => $category->name,
            'is_active' => $category->is_active
        ];
    }
}
