<?php

namespace Xiashaung\Inject\Middleware;

class ControllerInject
{
    public function handle($request,\Closure $next)
    {
        $actionName = $request->route()->getActionName();
        if ($actionName != 'Closure'){
            $controller = $request->route()->getController();
            $controller = inject($controller);
            $request->route()->controller = $controller;
        }

        return $next($request);
    }
}
