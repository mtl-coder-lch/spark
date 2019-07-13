<?php

namespace App\Components\Routing;

use App\Components\Request\Request;

class Router
{
    const ROUTES_FILE_PATH = __DIR__ . '/../../routes.yml';

    private $routes;
    /**
     * @var Route|bool|mixed
     */
    private $matchedRoute;

    /**
     * Router constructor.
     * @param Request $request
     * @throws \Exception
     */
    public function __construct(Request $request)
    {
        $routesParser = new RoutesParser($request);
        $this->routes = $routesParser->parse()->getRoutes();
        $this->matchedRoute = (new RouteMatcher())->resolve($this->routes, $request);
        $this->executeController();
    }

    public function executeController()
    {
        $controllerName = $this->matchedRoute->getController().'Controller';
        $namespace = 'App\\Components\\Controller\\';
        $namespacedController = $namespace . $controllerName;
        $action = $this->matchedRoute->getAction();
        (new $namespacedController)->$action();
    }
}
