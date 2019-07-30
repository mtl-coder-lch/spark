<?php

namespace App;

use App\Components\Controller\ControllerResolver;
use App\Components\Request\Request;
use App\Components\Routing\Router;
use App\Components\View\View;
use ReflectionException;

class App
{
    private $router;
    private $matchedRoute;
    private $controllerResolver;
    private $request;
    private $view;

    /**
     * App constructor.
     * @param Router $router
     * @param Request $request
     * @param ControllerResolver $controllerResolver
     */
    public function __construct(Router $router, Request $request, ControllerResolver $controllerResolver, View $view)
    {
        $this->router = $router;
        $this->request = $request;
        $this->controllerResolver = $controllerResolver;
        $this->view = $view;
    }

    /**
     * @throws ReflectionException
     */
    public function init()
    {
        $this->view;
        $this->matchedRoute = $this->router->getMatchedRoute();
        $this->controllerResolver->resolve($this->matchedRoute, $this->request);
    }
}
