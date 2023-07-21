<?php

namespace Xiashaung\Inject\Middleware;

use Xiashaung\Inject\CheckLogin;

abstract class LaravelCheckLoginMiddleware
{
    public function handel($request, \Closure $next)
    {
        $route = $request->route();
        $actionName = $route->getActionName();
        $check = new CheckLogin();
        if ($actionName != 'Closure') {
            $status = $check->check($route->getController(), $route->getActionMethod());
        } else {
            $status = $check->checkFunction($route->getAction('uses'));
        }
        if ($status) {
            $request = $this->needLogin($request);
        }
        return $next($request);
    }


    abstract public function needLogin($request);
}
