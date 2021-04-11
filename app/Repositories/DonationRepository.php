<?php

namespace App\Repositories;

use App\Interfaces\DonationRepositoryInterface;
use App\Models\Donation;

class DonationRepository implements DonationRepositoryInterface
{
    public function getAllDonations()
    {
        return Donation::all();
    }

    public function storeDonation($order_id)
    {
        $data = Donation::create([
            'order_id' => $order_id
        ]);

        if (!$data) {
            throw new Exception("Failed to create donation", 1);
        }

        return $data;
    }
}
