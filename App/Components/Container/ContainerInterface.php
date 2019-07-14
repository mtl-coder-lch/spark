<?php

namespace App\Components\Container;

use ReflectionException;

interface ContainerInterface
{
    public static function get($key);

    public static function getAll();

    /**
     * @param $className
     * @return object
     * @throws ReflectionException
     */
    public function resolve($className);
}
