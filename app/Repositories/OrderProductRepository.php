<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order\OrderProduct;

class OrderProductRepository
{
    public function store(array $data): void
    {
        OrderProduct::query()->insert($data);
    }
}