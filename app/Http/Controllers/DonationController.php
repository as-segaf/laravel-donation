<?php

namespace App\Http\Controllers;

use App\Services\DonationService;
use Illuminate\Http\Request;

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
}
