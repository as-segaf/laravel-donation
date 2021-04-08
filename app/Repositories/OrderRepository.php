<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder($request)
    {
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount,
        ]);

        if (!$order) {
            throw new Exception("Failed to create order", 1);
        }

        return $order;
    }
}
