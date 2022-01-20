<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\VoteRepositoryInterface;
use App\Repositories\Eloquent\VoteRepository;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\CommentRepositoryInterface;
use App\Repositories\Eloquent\CommentRepository;
use App\Repositories\Eloquent\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->bind(
            VoteRepositoryInterface::class,
            VoteRepository::class
        );
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
