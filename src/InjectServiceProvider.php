<?php

namespace Xiashuang\Inject;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
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
