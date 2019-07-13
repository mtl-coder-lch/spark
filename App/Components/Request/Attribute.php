<?php

namespace App\Components\Request;

class Attribute
{
    private $type;
    private $data;

    public function __construct($type, $data = [])
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function get($key)
    {
        return $this->data[$key];
    }

    public function all()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
