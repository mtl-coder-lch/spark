<?php

namespace App\Components\Container;

use ReflectionClass;
use ReflectionException;

class ContainerDi implements ContainerInterface
{
    private static $instances;

    public static function get($key)
    {
        return self::$instances[$key];
    }

    public static function getAll()
    {
        return self::$instances;
    }

    /**
     * @param $className
     * @return object
     * @throws ReflectionException
     */
    public function resolve($className)
    {
        if(isset(self::$instances[$className]))
        {
            return self::$instances[$className];
        }

        $class =  new ReflectionClass($className);

        $constructor = $class->getConstructor();

        if(!$constructor || !$constructor->getParameters())
        {
            if(!isset(self::$instances[$className]))
            {
                return self::$instances[$className] = new $className;
            }
            else
            {
                return self::$instances[$className];
            }
        }

        $parameters = $constructor->getParameters();

        $instances = [];

        foreach ($parameters as $parameter)
        {
            $instances[] = $this->resolve($parameter->getClass()->getName());
        }

        return $class->newInstanceArgs($instances);
    }
}
