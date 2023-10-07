<?php

namespace App\Repository\Categorization\Favourites;

use App\Models\Favourit;
use App\Models\Product;
use App\Models\Type;
use App\Models\User;
use App\Traits\GeneralTrait;
use App\Traits\RatingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;


class FavouriteRepository implements FavouriteRepositoryInterface
{


    public function getAllFavourites() {
        $user =  Auth::user();
        $favourites = Favourit::query()->where('user_id',$user->id)->get();
        return successResponse($favourites);

    }


    public function create(  $product ) {
        $user_id =  Auth::user();
        // return $product;
        $user = User::query()->where('id',$user_id->id)->first();
        $products = Product::query()->where('id',$product->product_id)->first();
        // return $products;
        $data =  $user->favourites()->syncWithoutDetaching($products->id) ;


        return successResponse($data);


    }



    public function deleteFavourite(Favourit $favourit) {
        
        $favourit->delete();

        return successResponse($favourit);

    }


}
