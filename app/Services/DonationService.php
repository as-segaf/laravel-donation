<?php

namespace App\Services;

use App\Interfaces\DonationRepositoryInterface;

class DonationService
{
    protected $donationRepository;

    public function __construct(DonationRepositoryInterface $donationRepository)
    {
        return $this->donationRepository = $donationRepository;
    }

    public function index()
    {
        return $this->donationRepository->getAllDonations();
    }

    public function store($request)
    {
        $donation = $this->donationRepository->storeDonation($request);

        Midtrans\Config::$serverKey = 'SB-Mid-server-N8nj5ENZHnSH7nvZ14nuCH94';
        Midtrans\Config::$isProduction = false;
        Midtrans\Config::$isSanitized = true;
        Midtrans\Config::$is3ds = true;

        $snapToken = Midtrans\Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => $donation->id,
                'gross_amount' => $donation->amount
            ]
        ]);

        $donation['snapToken'] = $snapToken;

        return $donation;
    }
}
