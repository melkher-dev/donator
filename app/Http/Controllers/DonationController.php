<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('donations');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
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
