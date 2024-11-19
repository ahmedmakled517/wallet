<?php
namespace App\Services;

use App\Repositories\Contracts\DonationRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\WalletTransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DonationService
{
    protected $donationRepository;
    protected $userRepository;
    protected $transactionRepository;

    public function __construct(
        DonationRepositoryInterface $donationRepository,
        UserRepositoryInterface $userRepository,
        WalletTransactionRepositoryInterface $transactionRepository
    ) {
        $this->donationRepository = $donationRepository;
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function donate($partnerId, $amount, $paymentMethod)
    {
        $user = $this->userRepository->getAuthenticatedUser();

        if ($paymentMethod === 'wallet' && $user->wallet_balance < $amount) {
            throw new \Exception('Insufficient wallet balance');
        }

        DB::transaction(function () use ($partnerId, $user, $amount, $paymentMethod) {
            $donationData = [
                'user_id' => $user->id,
                'partner_id' => $partnerId,
                'amount' => $amount,
                'payment_method' => $paymentMethod,
                'status' => 'paid',
            ];
            $this->donationRepository->createDonation($donationData);

            if ($paymentMethod === 'wallet') {
                $this->userRepository->updateWalletBalance($user->id, -$amount);
                $this->transactionRepository->createTransaction([
                    'app_user_id' => $user->id,
                    'debit' => $amount,
                    'balance' => $user->wallet_balance,
                    'transaction_type' => 'deduction',
                    'process' => 'Donation',
                ]);
            }
        });
    }
}
