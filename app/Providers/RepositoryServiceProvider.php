<?php

namespace App\Providers;

use App\Contract\CartItemRepositoryInterface;
use App\Contract\CategoryRepositoryInterface;
use App\Contract\MediaRepositoryInterface;
use App\Contract\ProductRepositoryInterface;
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
    }
}
