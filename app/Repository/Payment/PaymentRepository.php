<?php

namespace App\Repository\Payment;

use App\Models\Billing;
use App\Models\PaidProduct;
use App\Models\Product;
use App\Traits\AddressTrait;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
    use AddressTrait;
    public function buyProducts($request)
    {
        $addressData = [
            'city' => $request->city,
            'street' => $request->street,
            'block' => $request->block,
            'building' => $request->building,
            'floor' => $request->floor,
            'site_num'=> $request->site_num,
            'type'=> $request->type,
            'user_id'=> Auth::id(),
        ];
        try {
            $products = Product::query()
                ->whereIn('id', $request->products)
                ->with('type', function ($q) {
                    $q->with('category', function ($q) {
                        $q->with('store');
                    });
                })->get();
            $itemsPrice = $products->sum('price');
            $delivaryPrice = $request->delivary_price;
            $total_price = $itemsPrice + $delivaryPrice;

            DB::beginTransaction();
            $address = $this->createAddress($addressData);
            $billing = Billing::query()->create([
                'address_id' => $address->id,
                'items_price' => $itemsPrice,
                'delivery_price' => $delivaryPrice,
                'total_price' => $total_price,
                'payment_method_id' => $request->payment_method_id,
                'notes' => $request->notes,
                'status_id' => 1
            ]);
            foreach ($products as $key => $product) {
                if ($request->quantity[$key] > $product->quantity) {
                    return errorResponse('The number of products is large', 400);
                }
                PaidProduct::query()->create([
                    'billing_id' => $billing->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'description' => $product->description,
                    'store' => $product->type->category->store->name,
                    'category' => $product->type->category->name,
                    'type' => $product->type->name,
                    'quantity' => $request->quantity[$key],
                ]);
                $product->update(['quantity' => $product->quantity - (int)$request->quantity[$key]]);
            }
            DB::commit();
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return  response()->json([
                'error' => 'Bad Request'
            ], 400);
        }
        return successResponse($billing->load('address','paidProducts'));
    }

    public function deleteBilling(Billing $billing)
    {
        $billing->delete();
    }

    public function getUserBillings($user) {
        $billings = [];
        $addresses = $this->getUserAddresses($user->id);
        foreach ($addresses as $address) {
            $billings[] = Billing::query()->where('address_id', $address->id)->get();
        }
        return successResponse($billings);
    }
}
