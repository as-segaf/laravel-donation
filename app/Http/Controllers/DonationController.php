<?php

namespace App\Http\Controllers;

use App\Services\DonationService;

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
        try {
            $data = $this->donationService->store($request);
        } catch (\Exception $exception) {
            return redirect('/donation')->with('error', $exception->getMessage());
        }

        return view('donation.pay', compact('data'));
    }
}
