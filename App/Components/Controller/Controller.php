<?php

namespace App\Components\Controller;

use App\Components\Request\Request;

trait Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
