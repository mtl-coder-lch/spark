<?php

namespace App\Components\Routing;

use App\Components\Collection\Collection;
use App\Components\Reader\Line;
use App\Components\Reader\YamlReader;
use App\Components\Request\Request;
use Exception;

class RoutesParser
{
    const ROUTES_FILE_PATH = __DIR__ . '/../../routes.yml';

    private $routes;
    private $request;
    private $data;
    private $reader;

    /**
     * RoutesParser constructor.
     * @param Request $request
     * @param YamlReader $yamlReader
     * @throws Exception
     */
    public function __construct(Request $request, YamlReader $yamlReader)
    {
        $this->request = $request;
        $this->reader = $yamlReader;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function parse()
    {
        $this->data = $this->reader->read(self::ROUTES_FILE_PATH);
        /**
         * @var $line Line
         */
        foreach ($this->data as $line)
        {
            if($line->getNumberOfSpaces() == 2)
            {
                $key = $line->getKey();
                $this->routes[$key]['name'] = trim($key);
                continue;
            }

            if(isset($key))
            {
                $this->routes[$key][$line->getKey()] = trim($line->getValue());
            }

        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        $routesObj = [];

        foreach ($this->routes as $route)
        {
            $routesObj[] = new Route($route['name'], $route['path'], $route['controller'], $route['action']);
        }
        return new Collection($routesObj);
    }
}
