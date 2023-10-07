<?php
namespace App\Traits;
use App\Models\Address;
use App\Models\Light_Delivery_Addresse;

trait AddressTrait {
    public function createAddress($data) {
        $address = Address::query()
            ->where('city', $data['city'])
            ->where('street', $data['street'])
            ->where('block', $data['block'])
            ->where('building', $data['building'])
            ->where('floor', $data['floor'])
            ->where('site_num', $data['site_num'])
            ->where('type', $data['type'])
            ->where('user_id', $data['user_id'])
            ->first();
        if (! isset($address)) {
            $address = Address::query()->create($data);
        }
        return $address;
    }

    public function createLightDeliveryAddress($data) {
        $address = Light_Delivery_Addresse::query()
            ->where('city', $data['city'])
            ->where('street', $data['street'])
            ->where('block', $data['block'])
            ->where('building', $data['building'])
            ->where('floor', $data['floor'])
            ->where('site', $data['site'])
            ->where('type', $data['type'])
            ->first();
        if (! isset($address)) {
            $address = Light_Delivery_Addresse::query()->create($data);
        }
        return $address;
    }
}
