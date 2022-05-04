<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order\Order;
use App\DataTransferObjects\OrderDTO;
use App\Repositories\OrderRepository;

class OrderService
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function all(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->orderRepository->all();
    }

    public function store(OrderDTO $DTO): Order
    {
        return $this->orderRepository->store($DTO);
    }

    ############################## [CUSTOM METHOD] ##############################

    public function findById(int $orderId): ?Order
    {
        return $this->orderRepository->findById($orderId);
    }

    public function findTransactionById(string $transactionId): ?Order
    {
        return $this->orderRepository->findTransactionById($transactionId);
    }

    public function changeStatus(int $orderId): void
    {
        $this->orderRepository->changeStatus($orderId);
    }

    public function exists(int $orderId): bool
    {
        return $this->orderRepository->exists($orderId);
    }
}