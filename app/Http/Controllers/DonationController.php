<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        return view('donations');
    }

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
