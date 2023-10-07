<?php
namespace App\Repository\Categorization\Store;

use App\Models\Store;

interface StoreRepositoryInterface {
    public function getAllStores();

    public function getStoreById(Store $store);

    public function create($data);
    public function update(Store $store, $data);

    public function deleteStore(Store $store);
    public function getRecommendedStores();

    public function getTopRatedStores($storesNumber);

}
