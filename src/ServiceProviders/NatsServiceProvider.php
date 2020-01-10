<?php

namespace Paperstreetmedia\Auth\ServiceProviders;

use Auth;
use App\Extensions\RiakUserProvider;
use Illuminate\Support\ServiceProvider;
use Paperstreetmedia\Auth\NatsUserProvider;

class NatsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('nats', function($app) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
            return new NatsUserProvider;
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}