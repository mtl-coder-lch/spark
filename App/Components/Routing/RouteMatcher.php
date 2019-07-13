<?php

namespace App\Components\Routing;

use App\Components\Collection\Collection;
use App\Components\Request\Request;

class RouteMatcher
{
    public function resolve(Collection $routes, Request $request)
    {
        $partsRequest = explode('/', $request->getUriWithRemovedQueryString());
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
