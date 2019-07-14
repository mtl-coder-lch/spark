<?php

namespace App\Components\Reader;

class Line
{
    private $key;
    private $value;
    private $numberOfSpaces;

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return  $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberOfSpaces()
    {
        return $this->numberOfSpaces;
    }

    /**
     * @param $numberOfSpaces
     * @return $this
     */
    public function setNumberOfSpaces($numberOfSpaces)
    {
        $this->numberOfSpaces = $numberOfSpaces;
        return $this;
    }
}
