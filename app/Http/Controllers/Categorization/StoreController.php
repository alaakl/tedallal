<?php

namespace App\Http\Controllers\Categorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Repository\Categorization\Store\StoreRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    protected $storeRepository;
    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index()
    {
        return successResponse($this->storeRepository->getAllStores());
    }

    public function store(CreateStoreRequest $request)
    {
        $store = $this->storeRepository->create($request);
        return $store;
    }

    public function show(Store $store)
    {
        return $this->storeRepository->getStoreById($store);
    }

    public function update(UpdateStoreRequest $request, Store $store)
    {
        return successResponse($this->storeRepository->update($store, $request));
    }

    public function destroy(Store $store)
    {
        $this->storeRepository->deleteStore($store);
        return successMessage('deleted success');
    }

    public function addRating(Request $request, Store $store) {
        $request->validate([
            'rate' => 'required|numeric|min:0|max:5'
        ]);
        $rate =  $store->addRating($request->rate, Auth::id());
        return successResponse($rate);
    }

    public function getRatings(Store $store) {
        return successResponse($store->getRatingsInfo());
    }

    public function getTopRatedStores() {
        $storesNumber = \request()->query('stores');
        return successResponse($this->storeRepository->getTopRatedStores($storesNumber));
    }

    public function getRecommendedStores() {
        return successResponse($this->storeRepository->getRecommendedStores());
    }

}
