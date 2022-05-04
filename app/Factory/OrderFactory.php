<?php

declare(strict_types=1);

namespace App\Factory;

use App\Enums\TransactionStatusEnum;
use App\DataTransferObjects\OrderDTO;

class OrderFactory
{
    public function create(string $transactionId = null): OrderDTO
    {
        return new OrderDTO([
            'transaction'   => $transactionId,
            'status'        => TransactionStatusEnum::pending()->value,
            'sku'           => '#SK' . rand(10**3, 10**4),
            'user_id'       => auth()->id()
        ]);
    }
}