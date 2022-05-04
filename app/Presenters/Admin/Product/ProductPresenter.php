<?php

namespace App\Presenters\Admin\Product;

use App\Models\Product\Product;

class ProductPresenter
{
    public static function items(): array
    {
        return Product::orderBy('sku')
            ->get()
            ->map(function (Product $item) {

                return [
                    'id' => $item->id,
                    'sku' => $item->sku,
                    'imageSrc' => '', //todo
                    'name' => $item->name,
                    'categoryName' => $item->category->name,
                    'price' => $item->price ?: '',
                    'quantity' => $item->quantity ?: '',
                    'isInStock' => $item->in_stock
                ];
            })->toArray();

    }

}
