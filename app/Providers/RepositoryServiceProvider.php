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
use App\Repository\LightDelivery\LightDeliveryInterface;
use App\Repository\Rating\RatingRepository;
use App\Repository\Rating\RatingRepositoryInterface;
use App\Repository\RegisterUserRepository;
use App\Repository\RegisterUserRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use LightDelivery;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(RegisterUserRepositoryInterface::class, RegisterUserRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
