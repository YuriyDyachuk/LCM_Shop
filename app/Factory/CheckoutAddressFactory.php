<?php

declare(strict_types=1);

namespace App\Factory;

use App\Enums\BillingStatusEnum;
use App\DataTransferObjects\CheckoutAddressDTO;
use App\Http\Requests\Product\ShippingAddressRequest;

class CheckoutAddressFactory
{
    public function create(ShippingAddressRequest $request): CheckoutAddressDTO
    {
        return new CheckoutAddressDTO([
            'billing_status'    => isset($request->billing_same)
                                ? BillingStatusEnum::published()->value
                                : BillingStatusEnum::not_published()->value,
            'company_name'      => $request->input('company'),
            'first_name'        => $request->input('first_name'),
            'last_name'         => $request->input('last_name'),
            'post_code'         => $request->input('post_code'),
            'address'           => $request->input('address'),
            'country'           => $request->input('country'),
            'user_id'           => $request->user()->id,
            'phone'             => $request->input('phone'),
            'state'             => $request->input('state'),
            'suite'             => $request->input('suite'),
            'city'              => $request->input('city')
        ]);
    }
}