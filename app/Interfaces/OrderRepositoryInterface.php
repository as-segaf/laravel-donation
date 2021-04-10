<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function createOrder($request);

    public function updateStatus($status, $id);
}
