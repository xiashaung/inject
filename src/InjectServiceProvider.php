<?php

namespace Xiashaung\Inject;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Xiashaung\Inject\Middleware\ControllerInject;

class InjectServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Route::pushMiddlewareToGroup('api',ControllerInject::class);
        Route::pushMiddlewareToGroup('web',ControllerInject::class);
    }
}
