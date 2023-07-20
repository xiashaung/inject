<?php

if (!function_exists('inject')) {
    /**
     * @template T
     * @param class-string<T> $class
     * @param $args
     * @return mixed|object|null|T
     * @throws ReflectionException
     */
    function inject($class, $args = [])
    {
        $ref = new ReflectionClass($class);
        if (is_string($class)) {
            if (method_exists($class, 'make')) {
                $class = $class::make();
            } else {
                if (function_exists('app')) {
                    $class = app($class, $args);
                } else {
                    $class = $ref->newInstanceArgs($args);
                }
            }
        }
        $properties = $ref->getProperties();
        foreach ($properties as $property) {
            $inject = $property->getAttributes(Xiashaung\Inject\Attribute\Inject::class);
            if ($inject) {
                $typeName = $property->getType()->getName();
                if (class_exists($typeName)) {
                    $property->setValue($class, inject($typeName));
                }
            }
        }
        return $class;
    }
}

