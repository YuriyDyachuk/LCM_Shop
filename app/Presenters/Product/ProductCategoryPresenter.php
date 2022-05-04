<?php

namespace App\Presenters\Product;

use App\Models\Product\Product;
use Illuminate\Support\Collection;

class ProductCategoryPresenter
{
    public static function items(Collection $products): array
    {
        return $products
            ->map(function (Product $item) {

                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'img'  => $item->image,
                    'price' => $item->price,
                    'url' => route('product.detail', ['product' => $item->id])
                ];
            })
            ->toArray();

    }

}
