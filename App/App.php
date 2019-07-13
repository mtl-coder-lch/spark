<?php

namespace App;

use App\Components\Request;

class App
{
    public function __construct()
    {
        $request = new Request();
        var_dump($request->query->get('bla'));
    }
}
