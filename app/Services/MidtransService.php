<?php

namespace App\Services;

use App\Interfaces\DonationRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use Midtrans;

class MidtransService
{
    protected $orderRepository;
    protected $donationRepository;

    public function __construct(OrderRepositoryInterface $orderRepository,DonationRepositoryInterface $donationRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->donationRepository = $donationRepository;
    }

    public function getNotification()
    {
        Midtrans\Config::$serverKey = 'SB-Mid-server-N8nj5ENZHnSH7nvZ14nuCH94';
        Midtrans\Config::$isProduction = false;

        $notification = new Midtrans\Notification();
        
        $transactionStatus = $notification->transaction_status;
        $order_id = $notification->order_id;

        $order = $this->orderRepository->updateStatus($transactionStatus, $order_id);
        $order['message'] = 'Success update order status';

        if ($order->status == 'settlement') {
            $donation = $this->donationRepository->storeDonation($order->id);
            $donation['message'] = 'Success, payment has been recevied and donation created';
            
            return $donation;
        }

        return $order;
    }
}
