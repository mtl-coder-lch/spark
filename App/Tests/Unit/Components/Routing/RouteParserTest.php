<?php

namespace App\Tests\Unit\Components\Routing;

use App\Components\Reader\Line;
use App\Components\Reader\YamlReader;
use App\Components\Request\Request;
use App\Components\Routing\RoutesParser;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Exception;

class RouteParserTest extends TestCase
{
    private $request;
    private $reader;

    public function setUp()
    {
        $this->request = $this->prophesize(Request::class);
        $this->reader = $this->prophesize(YamlReader::class);
    }

    /**
     * @throws Exception
     */
    public function testRouteIsParsed()
    {
        $dataFromReader = [
            (new Line())
                ->setValue('')
                ->setNumberOfSpaces(0)
                ->setKey('routes'),
            (new Line())
                ->setValue('test')
                ->setNumberOfSpaces(2)
                ->setKey('test'),
            (new Line())
                ->setValue('test')
                ->setNumberOfSpaces(4)
                ->setKey('name'),
            (new Line())
                ->setValue('/test/{first}/route/{second}')
                ->setNumberOfSpaces(4)
                ->setKey('path'),
            (new Line())
                ->setValue('Test')
                ->setNumberOfSpaces(4)
                ->setKey('controller'),
            (new Line())
                ->setValue('test')
                ->setNumberOfSpaces(4)
                ->setKey('action'),
        ];

        $routeParser = new RoutesParser($this->request->reveal(), $this->reader->reveal());
        $this->reader->read(Argument::type('string'))->willReturn($dataFromReader);
        $routes = $routeParser->parse()->getRoutes();
        $this->assertEquals('/test/{first}/route/{second}', $routes[0]->getPath());
    }
}
