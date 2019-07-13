<?php

namespace App;

use App\Components\Request\Request;
use App\Components\Routing\Router;

class App
{
    public function __construct()
    {
        $request = new Request();
        $router = new Router($request);
    }
}
