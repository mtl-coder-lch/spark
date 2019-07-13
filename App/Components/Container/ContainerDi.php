<?php

namespace App\Components\Container;

use ReflectionClass;
use ReflectionException;

class ContainerDi
{

    /**
     * @param $className
     * @return object
     * @throws ReflectionException
     */
    public function resolve($className)
    {
        $class = new ReflectionClass($className);

        $constructor = $class->getConstructor();

        if(!$constructor)
        {
            return new $className;
        }

        $parameters = $constructor->getParameters();

        if(!$parameters)
        {
            return new $className;
        }

        $instances = [];

        foreach ($parameters as $parameter)
        {
            $instances[] = $this->resolve($parameter->getClass()->getName());
        }

        return $class->newInstanceArgs($instances);
    }
}
