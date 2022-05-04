<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CheckoutAddressDTO extends DataTransferObject
{
    public string $billing_status;

    public string $company_name;

    public string $first_name;

    public string $last_name;

    public string $post_code;

    public string $address;

    public string $country;

    public int    $user_id;

    public string $phone;

    public string $state;

    public string $suite;

    public string $city;
}