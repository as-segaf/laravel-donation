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

    public function store($order_id)
    {
        $donation = $this->donationRepository->storeDonation($order_id);

        return $donation;
    }
}
