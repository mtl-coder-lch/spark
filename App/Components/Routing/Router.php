<?php

namespace App\Components\Routing;

use App\Components\Request\Request;
use App\Components\Reader\YamlReader;

class Router
{
    const ROUTES_FILE_PATH = __DIR__ . '/../../routes.yml';

    private $request;

    /**
     * Router constructor.
     * @param Request $request
     * @throws \Exception
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->analyzeUri();
    }

    /**
     * @throws \Exception
     */
    public function analyzeUri()
    {
        $yamlReader = new YamlReader();
        $data = $yamlReader->read(self::ROUTES_FILE_PATH);
        $routesParser = new RoutesParser();
        $routes = $routesParser->parse($data)->getRoutes();
        var_dump($routes);
    }
}
