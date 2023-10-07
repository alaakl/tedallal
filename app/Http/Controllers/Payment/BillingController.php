<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBillingRequest;
use App\Models\Billing;
use App\Models\Product;
use App\Models\RejectBilling;
use App\Models\User;
use App\Repository\Payment\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function buyProducts(StoreBillingRequest $request) {
       return $this->paymentRepository->buyProducts($request);
    }

    public function deleteBilling(Billing $billing) {
        $this->paymentRepository->deleteBilling($billing);
        return successMessage('deleted success');
    }

    public function rejectBilling(Request $request, Billing $billing) {
        $request->validate([
           'cause' => 'string'
        ]);
        if ($billing->status_id !== 5){
            RejectBilling::query()->create([
                'billing_id' => $billing->id,
                'cause' => $request->cause
            ]);
            $billing->update(['status_id' => 5 ]);
        }else {
            return errorResponse('This billing have been previously rejected', 200);
        }
        return successMessage('success');
    }

    public function getUserBillings () {
        $user = Auth::user();
        return $this->paymentRepository->getUserBillings($user);
    }

}
