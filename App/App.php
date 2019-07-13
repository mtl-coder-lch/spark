<?php

namespace App;

use App\Components\Routing\Router;

class App
{
    private $router;

    /**
     * App constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->router->init();
    }
}
