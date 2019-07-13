<?php

namespace App\Components\Routing;

use App\Reader\Line;

class RoutesParser
{
    private $routes;

    public function parse($lines)
    {
        /**
         * @var $line Line
         */
        foreach ($lines as $line)
        {
            if($line->getNumberOfSpaces() == 2)
            {
                $key = $line->getKey();
                $this->routes[$key]['name'] = $key;
                continue;
            }

            if(isset($key))
            {
                $this->routes[$key][$line->getKey()] = $line->getValue();
            }

        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
