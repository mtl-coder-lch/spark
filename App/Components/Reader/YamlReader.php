<?php

namespace App\Components\Reader;

use App\Components\Exception\CharactersNotValidException;
use App\Components\Exception\FileNotValidException;
use Exception;

class YamlReader
{
    private $data;
    private $routes;

    /**
     * @param string $file
     * @throws Exception
     */
    public function read(string $file)
    {
        try
        {
            $file = fopen($file, "r");
        }
        catch (Exception $e)
        {
            throw new FileNotValidException("File $file is not valid");
        }

        $this->routes = [];

        while(!feof($file))
        {
            $content = fgets($file);

            if($this->containsCharactersNotValid($content))
            {
                throw new CharactersNotValidException('Special characters found in yaml file, please make sure
                 all characters are valid');
            }

            if(!$this->onlyContainsSpaces($content))
            {
                $line = new Line();
                $line->setKey($this->getKeyByLine($content));
                $line->setNumberOfSpaces($this->countNumberOfSpaces($content));
                $line->setValue($this->getValueByLine($content));
                $this->data[] = $line;
            }
        }

        fclose($file);

        return $this->data;
    }

    private function getKeyByLine($line)
    {
        $key = preg_match('/\w+/', $line, $matches);

        if($key === 'routes')
        {
            return false;
        }

        return $matches[0];
    }

    private function getValueByLine($line)
    {
        preg_match('/:(?<value>.+)/', $line, $matches);
        if(isset($matches['value']))
        {
            return trim($matches['value']);
        }
        return '';
    }

    private function countNumberOfSpaces($line)
    {
        preg_match('/\s+/', $line, $matches);
        return strlen($matches[0]);
    }

    private function onlyContainsSpaces($line)
    {
        return strlen(trim($line)) === 0;
    }

    private function containsCharactersNotValid($line)
    {
        return preg_match('/[^A-Za-z0-9:\s\/{}]/', $line);
    }
}
