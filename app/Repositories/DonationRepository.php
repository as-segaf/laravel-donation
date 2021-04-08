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

    public function storeDonation($request)
    {
        $data = Donation::create([
            'name' => $request->name,
            'email' => $request->email,
            'amount' => $request->amount,
        ]);

        if (!$data) {
            throw new Exception("Failed to create donation", 1);
        }

        return $data;
    }
}
