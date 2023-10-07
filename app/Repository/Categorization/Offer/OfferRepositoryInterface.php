<?php

namespace App\Repository\Categorization\Offer;

interface OfferRepositoryInterface {

    public function getAllOffers();

    public function getOfferById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteOffer($id);
}
