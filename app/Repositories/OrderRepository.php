<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Order\Order;
use App\Enums\TransactionStatusEnum;
use App\DataTransferObjects\OrderDTO;

class OrderRepository
{
    public function all(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Order::query()
                    ->with(['user', 'products'])
                    ->orderByDesc('id')
                    ->paginate(10);
    }

    public function store(OrderDTO $DTO): Order
    {
        return Order::query()->create($DTO->toArray());
    }

    ############################## [CUSTOM METHOD] ##############################

    public function findById(int $id): ?Order
    {
        return Order::query()->find($id);
    }

    public function findTransactionById(string $transactionId): ?Order
    {
        return Order::query()->where(['transaction' => $transactionId])->first();
    }

    public function changeStatus(int $orderId): void
    {
        Order::query()
                ->where(['id' => $orderId])
                ->update(['status' => TransactionStatusEnum::completed()->value]);
    }

    public function exists(int $orderId): bool
    {
        return Order::query()->where(['id' => $orderId])->exists();
    }
}