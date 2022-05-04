<?php

namespace App\Presenters\Admin\Customer;

use App\Models\User;

class CustomerPresenter
{
    public static function items(): array
    {
        return User::orderBy('first_name')
            ->get()
            ->map(function (User $item) {
                return [
                    'id' => $item->id,
                    'name' => $item->fullName,
                    'membershipTypeName' => '', //todo
                    'orderCount' => '', //todo
                    'orderPriceTotal' => '', //todo
                    'createdAt' => $item->created_at->toDateString()
                ];
            })->toArray();

    }

}
