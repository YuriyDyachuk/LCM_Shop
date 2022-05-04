<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class OrderDTO extends DataTransferObject
{
    public string $transaction;

    public string $status;

    public string $sku;

    public int    $user_id;
}