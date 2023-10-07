<?php

namespace App\Repository\LightDelivery;

use App\Models\Item;
use App\Models\Light_Delivery_Image;
use App\Repository\LightDelivery\LightDeliveryRepositoryInterface;
use App\Traits\AddressTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LightDeliveryRepository implements LightDeliveryRepositoryInterface
{
    use AddressTrait;
    public function addDelivery($request){
        $sourceAddressData = [
            'city' => $request->source_city,
            'street' => $request->source_street,
            'block' => $request->source_block,
            'building' => $request->source_building,
            'floor' => $request->source_floor,
            'site'=> $request->source_site_num,
            'type'=> $request->source_type,
        ];

        $distinationAddressData = [
            'city' => $request->distination_city,
            'street' => $request->distination_street,
            'block' => $request->distination_block,
            'building' => $request->distination_building,
            'floor' => $request->distination_floor,
            'site'=> $request->distination_site_num,
            'type'=> $request->distination_type,
        ];
            foreach ($request->images as $image) {
                        $imageUrls[] = uploadFile('light_delivery/images/item', $image);
                    }

        try{
            DB::beginTransaction();
            $sourceAddress = $this->createLightDeliveryAddress($sourceAddressData);
            $distinationAddress = $this->createLightDeliveryAddress($distinationAddressData);
            $item = Item::query()->create(
                [
                    'title' => $request->title,
                    'description' => $request->description,
                    'state_id' =>1,
                    'user_id' => Auth::id(),
                    'source_id' => $sourceAddress->id,
                    'distination_id' => $distinationAddress->id,
                ]
            );
            if($imageUrls !== null) {
                foreach($imageUrls as $url) {
                    $images = Light_Delivery_Image::query()->create([
                        'url' => $url,
                        'item_id' => $item->id
                    ]);
                }
            }
                    DB::commit();
        }
        catch(\Exception $exception){
            DB::rollBack();
            return  response()->json([
                'error' => 'Bad Request'
            ], 400);
        }

        return successResponse($item->load('user', 'status', 'distinationAddresse', 'sourceAddresse','images'));
    }

    public function deleteDelivery($item)
    {
        $images =  $item->images;
        $item->distinationAddresse()->delete();
        $item->sourceAddresse()->delete();
        foreach($images as $image){
            deleteFile($image->url);
        }
        $item->images()->delete();
        $item->delete();
    }
}
