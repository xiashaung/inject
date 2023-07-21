<?php

namespace Xiashaung\Inject\Middleware;

use Xiashaung\Inject\CheckLogin;

abstract class LaravelCheckLoginMiddleware
{
    public function handel($request, \Closure $next)
    {
        $actionName = $request->route()->getActionName();
        $check = new CheckLogin();
        if ($actionName != 'Closure') {
            $status = $check->check($request->route()->getController(), $request->route()->getActionMethod());
        } else {
            $status = $check->checkFunction($request->route()->getAction('uses'));
        }
        if ($status) {
            $request = $this->needLogin($request);
        }
        return $next($request);
    }


    abstract public function needLogin($request);
}
