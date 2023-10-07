<?php

namespace App\Providers;

use App\Repository\Categorization\Category\CategoryRepository;
use App\Repository\Categorization\Category\CategoryRepositoryInterface;
use App\Repository\Categorization\Offer\OfferRepository;
use App\Repository\Categorization\Offer\OfferRepositoryInterface;
use App\Repository\Categorization\Product\ProductRepository;
use App\Repository\Categorization\Product\ProductRepositoryInterface;
use App\Repository\Categorization\Store\StoreRepository;
use App\Repository\Categorization\Store\StoreRepositoryInterface;
use App\Repository\Categorization\Type\TypeRepository;
use App\Repository\Categorization\Type\TypeRepositoryInterface;
use App\Repository\Categorization\Favourites\FavouriteRepository;
use App\Repository\Categorization\Favourites\FavouriteRepositoryInterface;
use App\Repository\LightDelivery\LightDeliveryRepository;
use App\Repository\LightDelivery\LightDeliveryRepositoryInterface;
use App\Repository\LoginUserRepository;
use App\Repository\Payment\PaymentRepository;
use App\Repository\Payment\PaymentRepositoryInterface;
use App\Repository\LoginUserRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use LightDelivery;

class repoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(OfferRepositoryInterface::class, OfferRepository::class);
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(FavouriteRepositoryInterface::class, FavouriteRepository::class);
        $this->app->bind(LightDeliveryRepositoryInterface::class, LightDeliveryRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
