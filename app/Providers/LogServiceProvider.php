<?php

namespace App\Providers;

use App\Observers\ModelObserver;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $observers = config('event.observers');

        foreach($observers as $observer) {
            $observer::observe(ModelObserver::class);
        }
    }
}
