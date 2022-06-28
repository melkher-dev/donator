<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreDonationRequest;

class DonationController extends Controller
{
     /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
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

                //график я хз шо тут
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

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('donations');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDonationRequest $request)
    {
        $donation = new Donation();
        $donation->donator_name = $request->donator_name;
        $donation->email = $request->email;
        $donation->amount = $request->amount;
        $donation->message = $request->message;
        $donation->save();

        return redirect()->route('dashboard');
    }
}
