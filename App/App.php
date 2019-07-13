<?php

namespace App;

use App\Components\Controller\ControllerResolver;
use App\Components\Request\Request;
use App\Components\Routing\Router;

class App
{
    private $router;
    private $matchedRoute;
    private $controllerResolver;
    private $request;

    /**
     * App constructor.
     * @param Router $router
     * @param Request $request
     * @param ControllerResolver $controllerResolver
     */
    public function __construct(Router $router, Request $request, ControllerResolver $controllerResolver)
    {
        $this->router = $router;
        $this->request = $request;
        $this->controllerResolver = $controllerResolver;
    }

    public function init()
    {
        $this->matchedRoute = $this->router->getMatchedRoute();
        $this->controllerResolver->resolve($this->matchedRoute, $this->request);
    }
}
