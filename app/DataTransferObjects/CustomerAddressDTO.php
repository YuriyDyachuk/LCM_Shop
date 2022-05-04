<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CustomerAddressDTO extends DataTransferObject
{
    public string $state_name;

    public string $city_name;

    public string $country;

    public string $zip_code;

    public string $address;
}