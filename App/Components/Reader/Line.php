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
     * @param mixed $key
     */
    public function setKey($key): void
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getNumberOfSpaces()
    {
        return $this->numberOfSpaces;
    }

    /**
     * @param mixed $numberOfSpaces
     */
    public function setNumberOfSpaces($numberOfSpaces): void
    {
        $this->numberOfSpaces = $numberOfSpaces;
    }
}
