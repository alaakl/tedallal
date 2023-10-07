<?php

namespace App\Repository\Categorization\Favourites;

use App\Models\Favourit;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

interface FavouriteRepositoryInterface {

    public function getAllFavourites();

    public function create(  $product );

    public function deleteFavourite(Favourit $favourit);
}
