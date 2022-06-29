<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Donation;
use App\Repositories\DonationRepository;

class DonationService
{
    private $donationRepository;

    public function __construct(DonationRepository $donationRepository)
    {
        $this->donationRepository = $donationRepository;
    }

    public function getData()
    {
        return [
            'donations' =>  $this->donationRepository->getPaginatedDonations(),
            'summ' => $this->donationRepository->getSumAmounts(),
            'biggestDonation' => $this->donationRepository->getBiggestDonation(),
            'lastMonth' => $this->donationRepository->getLastMonth(),
            'chart' => $this->donationRepository->getChart(),
        ];
    }

    public function saveData(array $data)
    {
        $this->donationRepository->saveDonate($data);
    }
}
