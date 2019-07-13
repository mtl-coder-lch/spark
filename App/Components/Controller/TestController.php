<?php

namespace App\Components\Controller;

class TestController
{
    use Controller;

    public function first($first, $second)
    {
        var_dump($this->request);
        echo $first. ' '. $second;
    }

    public function second()
    {
        echo 'second';
    }
}
