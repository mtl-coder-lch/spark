<?php

namespace App;

use App\Components\Request\Request;

class App
{
    public function __construct()
    {
        $request = new Request();
    }
}
