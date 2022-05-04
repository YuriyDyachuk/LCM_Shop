<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->all();

        return view('admin.orders', ['orders' => $orders]);

    }

    public function show(int $orderId)
    {
        if (!$this->orderService->exists($orderId)) {
            return redirect()->back()->withErrors('This product is not found. Try again!');
        }

        $order = $this->orderService->findById($orderId);

        return view('admin.order-details', ['order' => $order]);
    }
}
