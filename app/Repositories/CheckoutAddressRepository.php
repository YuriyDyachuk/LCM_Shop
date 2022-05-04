<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\CheckoutAddressDTO;
use App\Models\CheckoutAddresses;

class CheckoutAddressRepository
{
    public function create(CheckoutAddressDTO $DTO): void
    {
        CheckoutAddresses::query()->create($DTO->toArray())->refresh();
    }
}