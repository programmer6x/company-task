<?php

namespace App\Providers;

use App\Contract\CampaignRepositoryInterface;
use App\Contract\CampaignUserRepositoryInterface;
use App\Contract\CartItemRepositoryInterface;
use App\Contract\CategoryRepositoryInterface;
use App\Contract\MediaRepositoryInterface;
use App\Contract\ProductRepositoryInterface;
use App\Repositories\CampaignRepository;
use App\Repositories\CampaignUserRepository;
use App\Repositories\CartItemRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\MediaRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(MediaRepositoryInterface::class,MediaRepository::class);
        $this->app->bind(CartItemRepositoryInterface::class,CartItemRepository::class);
        $this->app->bind(CampaignRepositoryInterface::class,CampaignRepository::class);
        $this->app->bind(CampaignUserRepositoryInterface::class,CampaignUserRepository::class);
    }
}
