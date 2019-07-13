<?php

namespace App\Tests\Unit\Components\Reader;

use App\Components\Reader\YamlReader;
use PHPUnit\Framework\TestCase;
use Exception;

class YamlReaderTest extends TestCase
{
    const FILE_VALID = __DIR__ . '/files/routes_valid.yml';
    const FILE_NOT_VALID = __DIR__ . '/files/routes_not_valid.yml';

    /**
     * @throws Exception
     */
    public function testItCanReadFile()
    {
        $yamlReader = new YamlReader();
        $data = $yamlReader->read(self::FILE_VALID);
        $this->assertEquals('routes', $data[0]->getKey());
        $this->assertEquals('test', $data[1]->getKey());
    }

    /**
     * @throws Exception
     */
    public function testThrowsExceptionWhenContainsSpecialCharacter()
    {
        $this->expectException(Exception::class);
        $yamlReader = new YamlReader();
        $yamlReader->read(self::FILE_NOT_VALID);
    }

    /**
     * @throws Exception
     */
    public function testThrowsExceptionIfFileDoesNotExist()
    {
        $this->expectException(Exception::class);
        $yamlReader = new YamlReader();
        $yamlReader->read('any');
    }
}
