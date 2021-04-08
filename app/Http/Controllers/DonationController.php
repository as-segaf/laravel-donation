<?php

namespace App\Http\Controllers;

use App\Services\DonationService;
use Midtrans;

class DonationController extends Controller
{
    protected $donationService;

    public function __construct(DonationService $donationService)
    {
        return $this->donationService = $donationService;
    }

    public function index()
    {
        $datas = $this->donationService->index();

        return view('donation.index', compact('datas'));
    }

    public function store($request)
    {
        $data = $this->donationService->store($request);

        return view('donation.pay', compact('data'));
    }
}
