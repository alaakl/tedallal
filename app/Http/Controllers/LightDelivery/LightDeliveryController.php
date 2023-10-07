<?php

namespace App\Http\Controllers\LightDelivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLightDeliveryRequest;
use App\Models\Item;
use App\Repository\LightDelivery\LightDeliveryRepositoryInterface;
use Illuminate\Http\Request;

class LightDeliveryController extends Controller
{
    protected $LightDelivery;

    public function __construct(LightDeliveryRepositoryInterface $LightDelivery)
    {
        $this->LightDelivery = $LightDelivery;
    }

    public function storeDelivery(StoreLightDeliveryRequest $request) {

        return $this->LightDelivery->addDelivery($request);
    }

    public function deleteDelivery(Item $item) {
        return $this->LightDelivery->deleteDelivery($item);
    }
}
