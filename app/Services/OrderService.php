<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;
use Midtrans;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        return $this->orderRepository = $orderRepository;
    }

    public function getSnapTokenMidtrans($order_id, $gross_amount)
    {
        Midtrans\Config::$serverKey = 'SB-Mid-server-N8nj5ENZHnSH7nvZ14nuCH94';
        Midtrans\Config::$isProduction = false;
        Midtrans\Config::$isSanitized = true;
        Midtrans\Config::$is3ds = true;

        $snapToken = Midtrans\Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount
            ]
        ]);

        if (!$snapToken) {
            throw new Exception("Failed to get snap token midtrans", 1);
        }

        return $snapToken;
    }

    public function store($request)
    {
        $order = $this->orderRepository->createOrder($request);
        $order['snapToken'] = $this->getSnapTokenMidtrans($order->id, $order->amount);

        return $order;
    }
}
