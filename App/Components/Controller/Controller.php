<?php

namespace App\Components\Controller;

use App\Components\Request\Request;
use App\Components\View\View;

trait Controller
{
    private $request;
    private $view;

    public function __construct(Request $request, View $view)
    {
        $this->request = $request;
        $this->view = $view;
    }
}
