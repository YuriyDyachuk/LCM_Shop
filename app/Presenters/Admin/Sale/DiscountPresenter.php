<?php

namespace App\Presenters\Admin\Sale;

use App\Models\Sale\Discount;


class DiscountPresenter
{
    public static function items(): array
    {
        return Discount::orderBy('name')
            ->get()
            ->map(function (Discount $item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'typeName' => $item->typeName,
                    'priority' => $item->priority,
                    'is_active' => $item->is_active
                ];
            })->toArray();

    }

}
