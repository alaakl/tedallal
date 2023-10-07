<?php

namespace App\Repository\Categorization\Store;

use App\Models\Store;
use App\Repository\UserRepository;
use App\Traits\AddressTrait;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreRepository implements StoreRepositoryInterface
{
    use AddressTrait, GeneralTrait;

    public function getAllStores() {
        $stores = Store::all();
        $data = array_values($stores->toArray());
        return $data;
    }

    public function getStoreById(Store $store) {
        $result = [];
        $tests = $store->with('categories.types')->find($store->id);
        foreach ($tests->categories as $category ){
            foreach ($category->types as $value) {
                $value['products'] = $value->products()->paginate(2);
                $typesWithProducts[] = $value;
            }
            $test['types'] = $typesWithProducts;
            $result[] = $category;
        }

        return successResponse($result);
    }

    public function create($request) {
        if ($request->hasFile('commercial_record_image')) {
            $commercial_record_image = uploadFile('images/stores/commercial record', $request->commercial_record_image);
        }
        $imageUrl = uploadFile('images/stores', $request->image);
        try {
        DB::beginTransaction();
        $owner = $this->addUser($request, 2);
        $store = Store::query()->create([
            'name' => $request->name,
            'image' => $imageUrl,
            'minimum_cost' => $request->minimum_cost,
            'recommended' => $request->recommended,
            'status' => $request->status,
            'description' => $request->description,
            'city'  => $request->city,
            'street'  => $request->street,
            'block'  => $request->block,
            'building'  => $request->building,
            'floor'  => $request->floor,
            'site_num' => $request->site_num,
            'owner_id' => $owner->id,
            'commercial_record' => $commercial_record_image,
        ]);
        DB::commit();
        return successResponse($store);
        }
        catch (\Exception $exception) {
            DB::rollBack();
            return  response()->json([
                'error' => $exception->getMessage()
            ], 400);
        }


    }

    public function update(Store $store, $request)
    {
        $data = [
            'name' => $request->name,
            'minimum_cost' => $request->minimum_cost,
            'status' => $request->status,
            'description' => $request->description,
            'city'  => $request->city,
            'street'  => $request->street,
            'block'  => $request->block,
            'building'  => $request->building,
            'floor'  => $request->floor,
            'site_num' => $request->site_num,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = replaceFile($store->image, 'images/stores', $request->image);
        }
        $store->update($data);
        return $store;
    }

    public function deleteStore(Store $store) {
        deleteFile($store->image);
        $store->owner()->delete();
        $store->delete();
    }

    public function getTopRatedStores($storesNumber)
    {
        $stores =  Store::query()->get();
        $data = array_values($stores->sortByDesc('rating')->take($storesNumber)->toArray());
        return $data;
    }

    public function getRecommendedStores()
    {
        $stores =  Store::all();
        $result = $stores->filter(function ($store) {
           return $store->recommended == 1 || $store->rating > 4;
        });
        $data = array_values($result->toArray());
        return $data;
    }

}
