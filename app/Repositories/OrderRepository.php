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

    public function updateStatus($status, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $status;

        if ($order->save()) {
            return $order;
        }
        
        throw new Exception("Failed to update order status", 1);
    }
}
