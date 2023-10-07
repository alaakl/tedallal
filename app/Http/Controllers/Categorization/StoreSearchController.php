<?php


namespace app\Http\Controllers\Categorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreSearchController extends Controller
{
    public function search(SearchRequest $request){
        $name = $request->name;
        $stores = Store::query()->where('name','LIKE', '%'. $name . '%')->get();
        $products = Product::query()->where('name','LIKE', '%'. $name . '%')->get();
        $data['stores'] = $stores;
        $data['products'] = $products;
        return successResponse($data);
    }

    public function filterBy(FilterRequest $request) {
        $data2 = [];
        $data = [];
        $filterByLocation = $request->filter_by_location;
        $userLatitude = $request->user_latitude;
        $userLongitude = $request->user_longitude;
        $filterByDistance = $request->filter_by_distance;
        $filterByDeliveryPrice = (double)$request->filter_by_delivery_price;
        $storeQ = Store::query();

        if ($filterByDistance !== null) {
                if ($userLatitude !== null && $userLongitude !== null) {
                    $data2 = $this->getNearestStoresByPoints($userLatitude, $userLongitude, $filterByDistance);
                }
        }
        if ($filterByDeliveryPrice !== null) {
                $storeQ->where('minimum_cost', '<=', $filterByDeliveryPrice);
        }
        if ($filterByLocation !== null) {
               $data = Store::query()->where('city', '=', $filterByLocation)->get();
        }
        $merged  = $storeQ->get()->merge($data);
        $result = $merged->merge($data2);
        return successResponse($result);

    }

    public function SearchForProduct(Request $request){
        $search_By_Name = $request->input('search_By_Name');
        $store_Id   =  $request->input('store_Id');
        $product =
        DB::select("SELECT * FROM products WHERE type_id IN
        (SELECT id from types WHERE category_id in
         ( SELECT id FROM categories WHERE store_id = $store_Id))
          AND name LIKE '%$search_By_Name%' ");
        return response()->json([
            'data' => $product,
        ]);


    }

    public function getNearestStoresByPoints($userLatitude, $userLongitude, $requestDistance) {
        $data = [];
        $stores = Store::query()->get();
        foreach ($stores as $store) {
            $distance = point2point_distance($store->latitude, $store->longitude, $userLatitude, $userLongitude);
            if ($distance < $requestDistance)
            {
                $data[] = $store;
            }
        }
        return $data;
    }
}
