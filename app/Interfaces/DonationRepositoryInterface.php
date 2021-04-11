<?php

namespace App\Interfaces;

interface DonationRepositoryInterface
{
    public function getAllDonations();

    public function storeDonation($order_id);
}
