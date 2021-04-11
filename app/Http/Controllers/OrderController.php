<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        return $this->orderService = $orderService;
    }

    public function store(OrderRequest $request)
    {
        try {
            $data = $this->orderService->store($request);
        } catch (\Exception $exception) {
            return redirect('/donation')->with('error', $exception->getMessage());
        }

        return view('order.show', compact('data'));
    }
}
