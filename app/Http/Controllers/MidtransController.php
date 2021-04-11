<?php

namespace App\Http\Controllers;

use App\Services\MidtransService;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    protected $midtransService;
    

    public function __construct(MidtransService $midtransService)
    {
        return $this->midtransService = $midtransService;
    }

    public function getNotification()
    {
        try {
            $data = $this->midtransService->getNotification();
        } catch (\Exception $exception) {
            return response()->json([
                'code' => 500,
                'message' => $exception->getMessage(),
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => $data['message'],
            'data' => $data
        ]);
    }
}
