<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Services\DonationService;

class DonationController extends Controller
{
    protected $donationService;

    /**
     * Undocumented function
     *
     * @param \App\Services\DonationService $donationService
     */
    public function __construct(DonationService $donationService)
    {
        $this->donationService = $donationService;
    }

     /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('dashboard', $this->donationService->getData());
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
        $this->donationService->saveData($request->only(
            'donator_name',
            'email',
            'amount',
            'message'
        ));

        return redirect()->route('dashboard');
    }
}
