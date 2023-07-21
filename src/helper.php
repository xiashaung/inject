<?php

if (!function_exists('inject')) {
    /**
     * @template T
     * @param string|object|null|class-string<T> $class
     * @param array $args
     * @return mixed|object|null|T
     * @throws ReflectionException
     */
    function inject(string|object $class = null, array $args = [])
    {
        if (is_null($class)) {
            return Xiashaung\Inject\InjectManager::getInstance();
        }
        return Xiashaung\Inject\InjectManager::getInstance()->make($class, $args);
    }
}

