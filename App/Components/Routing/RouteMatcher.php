<?php

namespace App\Components\Routing;

use App\Components\Collection\Collection;
use App\Components\Request\Request;

class RouteMatcher
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

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

            foreach ($partsRoute as $keyPartRoute => $partRoute)
            {
                if(preg_match('/\{.+\}/',$partRoute) || $partsRequest[$keyPartRoute] === $partRoute)
                {
                    $matches[] = true;
                }
            }


            if(count($matches) === count($partsRoute))
            {
                return $route;
            }
        }
        return false;
    }
}
