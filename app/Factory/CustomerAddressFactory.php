<?php

declare(strict_types=1);

namespace App\Factory;

use Illuminate\Http\Request;
use App\DataTransferObjects\CustomerAddressDTO;

class CustomerAddressFactory
{
    public function create(Request $request): CustomerAddressDTO
    {
        return new CustomerAddressDTO([
            'state_name'    => $request->input('state'),
            'city_name'     => $request->input('city'),
            'zip_code'      => $request->input('post_code'),
            'country'       => $request->input('country'),
            'address'       => $request->input('address')
        ]);
    }
}