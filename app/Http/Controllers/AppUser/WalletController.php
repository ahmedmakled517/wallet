<?php
namespace App\Http\Controllers\AppUser;

use App\Http\Controllers\Controller;
use App\Services\WalletService;
use App\Services\DonationService;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected $walletService;
    protected $donationService;

    public function __construct(WalletService $walletService, DonationService $donationService)
    {
        $this->walletService = $walletService;
        $this->donationService = $donationService;
    }

    public function userBalance()
    {
        $balance = $this->walletService->getUserBalance();
        return response()->json(['user_balance' => $balance], 200);
    }

    public function addBalance(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);
        $this->walletService->addBalance($validated['amount'], ['transaction_type' => 'add', 'process' => 'add_balance']);
        return response()->json(['message' => 'Balance added successfully']);
    }

    public function donation($id, Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:wallet,mamopay',
        ]);

        $this->donationService->donate($id, $validated['amount'], $validated['payment_method']);
        return response()->json(['message' => 'Donation successful'], 200);
    }
}
