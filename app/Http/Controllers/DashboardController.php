<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        //переменные на начало и конец прошлого месяца
        $firstDayOfPreviousMonth = Carbon::now()->startOfMonth()->subMonthsNoOverflow();
        $lastDayOfPreviousMonth = Carbon::now()->subMonthsNoOverflow()->endOfMonth();

        $data = [
            'donations' => Donation::paginate(5),
            //сумма всех донатов
            'summ' => Donation::sum('amount'),
            //самый большой донат
            'biggestDonation' => Donation::orderBy('amount', 'desc')->first(),

            //вывод суммы за последний месяц
            'lastMonth' => Donation::where('created_at', '>=', $firstDayOfPreviousMonth)
                ->where('created_at', '<=', $lastDayOfPreviousMonth)
                ->sum('amount'),

                //график
            'chart' => Donation::selectRaw('DATE(created_at) as date, SUM(amount) as amount')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->map(function ($row) {
                    return [$row->date, (int) $row->amount];
                }),
        ];

        return view('dashboard', $data);
    }
}
