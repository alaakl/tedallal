<?php

namespace App\Http\Controllers\Favourites;

use App\Http\Controllers\Controller;
use App\Models\Favourit;
use App\Http\Requests\StoreFavouritRequest;
use App\Http\Requests\UpdateFavouritRequest;
use App\Models\Product;
use App\Repository\Categorization\Favourites\FavouriteRepositoryInterface;
use Illuminate\Http\Request;

class FavouritController extends Controller
{
    protected $Favourit;

    public function __construct(FavouriteRepositoryInterface $Favourit)
    {
        $this->Favourit = $Favourit;
    }

    public function store( StoreFavouritRequest $product)
    {
        return $this->Favourit->create( $product);
    }

    public function index( )
    {
        return $this->Favourit->getAllFavourites( );
    }

    public function destroy(Favourit $favourit )
    {
        return $this->Favourit->deleteFavourite($favourit );
    }

}
