<?php

namespace App\Components\Routing;

use App\Components\Request\Request;
use Exception;

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

    /**
     * @return Route|mixed
     * @throws Exception
     */
    public function getMatchedRoute()
    {
        $this->routes = $this->routesParser->parse()->getRoutes();
        return $this->matchedRoute = $this->routeMatcher->match($this->routes);
    }
}
