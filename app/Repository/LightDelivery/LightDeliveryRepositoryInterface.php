<?php


namespace App\Repository\LightDelivery;


interface LightDeliveryRepositoryInterface {

    public function addDelivery($request);

    public function deleteDelivery($item);

}
