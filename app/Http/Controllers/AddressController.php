<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Http\Requests\StoreaddressRequest;
use App\Http\Requests\UpdateaddressRequest;
use App\Traits\AddressTrait;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    use AddressTrait;
    public function index()
    {
        $user_id = Auth::id();
        $addressData = address::query()->where('user_id', $user_id)->get();
        return successResponse($addressData);
    }

    public function store(StoreaddressRequest $request)
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

        $addressData = $this->createAddress($addressData);
        return successResponse($addressData);
    }
}
