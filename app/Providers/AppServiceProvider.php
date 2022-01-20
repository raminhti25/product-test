<?php

namespace App\Providers;

use App\Models\Vote;
use App\Models\Comment;
use App\Observers\CommentObserver;
use App\Observers\VoteObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Vote::observe(VoteObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
