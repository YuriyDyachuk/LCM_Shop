<?php

namespace App\Presenters\Admin\Sale;

use App\Models\Sale\PromoCode;


class PromoCodePresenter
{
    public static function items(): array
    {
        return PromoCode::orderBy('is_active')
            ->get()
            ->map(function (PromoCode $item) {
                return [
                    'id' => $item->id,
                    'code' => $item->code,
                    'description' => $item->description,
                    'amount' => $item->amount,
                    'expiryDateAt' => $item->expiryDateAtDisplay,
                    'is_active' => $item->is_active
                ];
            })->toArray();

    }

}
