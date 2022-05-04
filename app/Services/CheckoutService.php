<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\CheckoutAddressDTO;
use App\Repositories\CheckoutAddressRepository;

class CheckoutService
{
    protected CheckoutAddressRepository $addressRepository;

    public function __construct(CheckoutAddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function create(CheckoutAddressDTO $DTO): void
    {
        $this->addressRepository->create($DTO);
    }
}