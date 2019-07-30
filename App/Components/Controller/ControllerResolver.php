<?php

namespace App\Components\Controller;

use App\Components\Container\ContainerDi;
use App\Components\Request\Request;
use App\components\Routing\Route;
use ReflectionClass;
use ReflectionException;

class ControllerResolver
{
    /**
     * @param Route $matchedRoute
     * @param Request $request
     * @throws ReflectionException
     */
    public function resolve(Route $matchedRoute, Request $request)
    {
        $controllerName = $matchedRoute->getController().'Controller';
        $namespace = 'App\\Components\\Controller\\';
        $namespacedController = $namespace . $controllerName;
        $action = $matchedRoute->getAction();
        $params = $request->getParams();

        $this->resolveControllerDependencies($namespacedController, $params, $action);
    }

    /**
     * @param $className
     * @param $params
     * @param $action
     * @return object|void
     * @throws ReflectionException
     */
    public function resolveControllerDependencies($className, $params, $action)
    {
        if(ContainerDi::get($className))
        {
            return ContainerDi::get($className);
        }

        $class =  new ReflectionClass($className);

        $constructor = $class->getConstructor();

        if(!$constructor || !$constructor->getParameters())
        {
            if(!ContainerDi::get($className))
            {
                return ContainerDi::set(new $className);
            }
            else
            {
                return ContainerDi::get($className);
            }
        }

        $parameters = $constructor->getParameters();

        $instances = [];

        foreach ($parameters as $parameter)
        {
            $instances[] = $this->resolveControllerDependencies($parameter->getClass()->getName(), $params, $action);
        }

        if($params && preg_match('/controller/i', $class->getNamespaceName()))
        {
            return $class->newInstanceArgs($instances)->$action(...$params);
        }
        elseif (preg_match('/controller/i', $class->getNamespaceName()))
        {

            return $class->newInstanceArgs($instances)->$action();
        }
        else
        {
            return $class->newInstanceArgs($instances);
        }
    }
}
