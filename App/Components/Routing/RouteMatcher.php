<?php

namespace App\Components\Routing;

use App\Components\Collection\Collection;
use App\Components\Request\Request;
use Exception;

class RouteMatcher
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Collection $routes
     * @return Route|mixed
     * @throws Exception
     */
    public function resolve(Collection $routes)
    {
        $partsRequest = explode('/', $this->request->getUriWithRemovedQueryString());
        array_shift($partsRequest);

        /**
         * @var $route Route
         */
        foreach ($routes as $route)
        {
            $matches = [];

            $partsRoute = explode('/', $route->getPath());
            array_shift($partsRoute);
            $params = [];

            foreach ($partsRoute as $keyPartRoute => $partRoute)
            {
                if(preg_match('/\{.+\}/',$partRoute) && isset($partsRequest[$keyPartRoute]))
                {
                    $params[] = $partsRequest[$keyPartRoute];
                    $matches[] = true;
                }
                elseif (isset($partsRequest[$keyPartRoute]) && $partsRequest[$keyPartRoute] === $partRoute)
                {
                    $matches[] = true;
                }
            }

            if(count($matches) === count($partsRoute))
            {
                $this->request->setParams($params);
                return $route;
            }
        }
        throw new Exception('There are no matching routes in the routes.yml file with the current url');
    }
}
