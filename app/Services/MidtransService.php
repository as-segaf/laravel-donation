<?php

namespace App\Services;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Donation;
use App\Services\OrderService;
use Midtrans;

class MidtransService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        return $this->orderRepository = $orderRepository;
    }

    public function getNotification()
    {
        Midtrans\Config::$serverKey = 'SB-Mid-server-N8nj5ENZHnSH7nvZ14nuCH94';
        Midtrans\Config::$isProduction = false;

        $notification = new Midtrans\Notification();
        
        $transactionStatus = $notification->transaction_status;
        $order_id = $notification->order_id;

        $order = $this->orderRepository->updateStatus($transactionStatus, $order_id);

        return $order;
    }
}
