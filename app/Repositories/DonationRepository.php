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
}
