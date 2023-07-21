<?php

namespace Xiashaung\Inject;


use ReflectionClass;
use Xiashaung\Inject\Attribute\Inject;

final class InjectManager
{
    private static InjectManager $instance;


    /**
     * @return InjectManager
     */
    public static function getInstance(): InjectManager
    {
        if (!self::$instance) {
            self::$instance = new InjectManager();
        }
        return self::$instance;
    }

    /**
     * @template T
     *
     * @param object|class-string<T> $class
     * @param array $args
     * @return void|T
     * @throws \ReflectionException
     */
    public function make(string|object $class, array $args = [])
    {
        $ref = new ReflectionClass($class);
        if (is_string($class)) {
            if (method_exists($class, 'make')) {
                $class = $class::make($args);
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
            $inject = $property->getAttributes(Inject::class);
            if ($inject && $property->hasType()) {
                $typeName = $property->getType()->getName();
                if (class_exists($typeName)) {
                    $property->setValue($class, $this->make($typeName));
                }
            }
        }
        return $class;
    }

    /**
     * @return CheckLogin
     */
    public function checkLogin(): CheckLogin
    {
        return new CheckLogin();
    }

}
