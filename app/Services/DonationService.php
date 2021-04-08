<?php

namespace App\Services;

use App\Interfaces\DonationRepositoryInterface;
use Midtrans;

class DonationService
{
    protected $donationRepository;

    public function __construct(DonationRepositoryInterface $donationRepository)
    {
        return $this->donationRepository = $donationRepository;
    }

    public function getSnapTokenMidtrans($order_id, $gross_amount)
    {
        Midtrans\Config::$serverKey = 'SB-Mid-server-N8nj5ENZHnSH7nvZ14nuCH94';
        Midtrans\Config::$isProduction = false;
        Midtrans\Config::$isSanitized = true;
        Midtrans\Config::$is3ds = true;

        $snapToken = Midtrans\Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $gross_amount
            ]
        ]);

        if (!$snapToken) {
            throw new Exception("Failed to get snap token midtrans", 1);
        }

        return $snapToken;
    }

    public function index()
    {
        return $this->donationRepository->getAllDonations();
    }

    public function store($request)
    {
        $donation = $this->donationRepository->storeDonation($request);
        $donation['snapToken'] = $this->getSnapTokenMidtrans($donation->id, $donation->amount);

        return $donation;
    }
}
