<?php

namespace App\Components\Request;

interface AttributeInterface
{
    /**
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @return mixed
     */
    public function getType();
}
