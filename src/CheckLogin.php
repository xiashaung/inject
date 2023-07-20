<?php

namespace Xiashaung\Inject;

use Xiashaung\Inject\Attribute\NeedLogin;
use Xiashaung\Inject\Attribute\NoNeedLogin;

class CheckLogin
{
    const NEED_LOGIN = true;

    const NO_NEED_LOGIN = false;

    /**
     * 检查是否需要登录
     *
     * @param $class
     * @param $method
     * @return bool|void true 需要登录 false 不需要登录
     * @throws \ReflectionException
     */
    public function check($class, $method)
    {
        $reflectionMethod = (new \ReflectionMethod($class, $method));
        if (count($reflectionMethod->getAttributes(NoNeedLogin::class))) {
            return false;
        }
        $reflectionClass = (new \ReflectionClass($class));
        if (count($reflectionClass->getAttributes(NeedLogin::class))) {
            return true;
        }
        if (count($reflectionMethod->getAttributes(NeedLogin::class))) {
            return true;
        }
    }

    /**
     *检查匿名函数是否需要登录
     *
     * @param $func
     * @return bool true 需要登录 false 不需要登录
     * @throws \ReflectionException
     */
    public function checkFunction($func)
    {
        $reflectionClass = (new \ReflectionFunction($func));
        if (count($reflectionClass->getAttributes(NeedLogin::class))) {
            return true;
        }
        return false;
    }
}
