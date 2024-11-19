<?php
namespace App\Repositories;

use App\Models\Donation;
use App\Repositories\Contracts\DonationRepositoryInterface;

class DonationRepository implements DonationRepositoryInterface
{
    public function createDonation(array $data)
    {
        return Donation::create($data);
    }
}
