<?php

namespace App\Components\Controller;

use App\Components\View\View;

class TestController
{
    use Controller;

    public function first($first, $second)
    {
        $data = [$first, $second];
        $this->view->setFile('/var/www/App/Components/View/test.php');
        return $this->view->render($data);
    }

    public function second()
    {
        echo phpinfo();die;
        echo 'second';
    }
}
