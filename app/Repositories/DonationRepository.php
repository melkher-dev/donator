<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Donation;

class DonationRepository
{
    private $model;

    public function __construct(Donation $donation)
    {
        $this->model = $donation;
    }

    public function getPaginatedDonations()
    {
        return  $this->model->paginate(5);
    }

    //сумма всех донатов
    public function getSumAmounts()
    {
        return  $this->model->sum('amount');
    }

    //самый большой донат
    public function getBiggestDonation()
    {
        return  $this->model->orderBy('amount', 'desc')->first();
    }

    //вывод суммы за последний месяц
    public function getLastMonth()
    {
        return $this->model->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonthsNoOverflow())
            ->where('created_at', '<=', Carbon::now()->subMonthsNoOverflow()->endOfMonth())
            ->sum('amount');
    }

    //график я хз шо тут
    public function getChart()
    {
        return  $this->model->selectRaw('DATE(created_at) as date, SUM(amount) as amount')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($row) {
                return [$row->date, (int) $row->amount];
            });
    }

    public function saveDonate(array $data)
    {
        $this->model->donator_name = $data['donator_name'];
        $this->model->email = $data['email'];
        $this->model->amount = $data['amount'];
        $this->model->message = $data['message'];
        $this->model->save();
    }
}
