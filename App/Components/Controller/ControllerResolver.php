<?php

namespace App\Components\Controller;

use App\Components\Container\ContainerDi;
use App\Components\Request\Request;
use App\components\Routing\Route;
use ReflectionClass;

class ControllerResolver
{
    /**
     * @param Route $matchedRoute
     * @param Request $request
     * @throws \ReflectionException
     */
    public function resolve(Route $matchedRoute, Request $request)
    {
        $controllerName = $matchedRoute->getController().'Controller';
        $namespace = 'App\\Components\\Controller\\';
        $namespacedController = $namespace . $controllerName;
        $action = $matchedRoute->getAction();
        $params = $request->getParams();

        $class = new ReflectionClass($namespacedController);

        $parameters = $class->getConstructor()->getParameters();

        $instances = [];

        foreach ($parameters as $parameter)
        {
            $instances[] = ContainerDi::get($parameter->getClass()->getName());
        }

        if($params)
        {
            $class->newInstanceArgs($instances)->$action(...$params);
        }
        else
        {
            $class->newInstanceArgs($instances)->$action();
        }
    }
}
