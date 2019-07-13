<?php

namespace App\Components\Request;

class Attribute implements AttributeInterface
{
    private $type;
    private $data;

    public function __construct($type, $data = [])
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->data[$key];
    }

    /**
     * @return array
     */
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
