<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\DataTransferObjects\CustomerAddressDTO;

class CustomerAddressService
{
    /**
     * @param CustomerAddressDTO $DTO
     * @return void
     *
     * this refactoring for repositories DB
     */
    public function create(CustomerAddressDTO $DTO): void
    {
        Auth::user()->address()->updateOrCreate(['user_id' => auth::id()], $DTO->toArray());
    }
}