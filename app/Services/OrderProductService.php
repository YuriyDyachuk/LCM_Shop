<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\OrderProductRepository;

class OrderProductService
{
    private OrderProductRepository $orderProductRepository;

    public function __construct(OrderProductRepository $orderProductRepository)
    {
        $this->orderProductRepository = $orderProductRepository;
    }

    public function attachProduct(int $orderId, array $productIds): void
    {
        foreach ($productIds as $productId) {
            $this->orderProductRepository->store($this->generateData($orderId, (int) $productId));
        }
    }

    private function generateData(int $orderId, int $productId): array
    {
        return [
            'order_id' => $orderId,
            'product_id' => $productId
        ];
    }
}