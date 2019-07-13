<?php

namespace App\Components\Routing;

use App\Components\Request\Request;

class Router
{
    const ROUTES_FILE_PATH = __DIR__ . '/../../routes.yml';

    private $routes;
    private $matchedRoute;
    private $routesParser;
    private $routeMatcher;
    private $request;

    /**
     * Router constructor.
     * @param Request $request
     * @param RoutesParser $routesParser
     * @param RouteMatcher $routeMatcher
     */
    public function __construct(Request $request, RoutesParser $routesParser, RouteMatcher $routeMatcher)
    {
        $this->routesParser = $routesParser;
        $this->routeMatcher = $routeMatcher;
        $this->request = $request;
    }

    public function init()
    {
        $this->routes = $this->routesParser->parse()->getRoutes();
        $this->matchedRoute = $this->routeMatcher->resolve($this->routes);
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
