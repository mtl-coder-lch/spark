<?php

namespace App\Tests\Unit\Components\Routing;

use App\Components\Collection\Collection;
use App\Components\Exception\NoMatchingRouteException;
use App\Components\Request\Request;
use App\components\Routing\Route;
use App\Components\Routing\RouteMatcher;
use PHPUnit\Framework\TestCase;
use Exception;

class RouteMatcherTest extends TestCase
{
    private $request;
    private $routeMatcher;

    public function setUp()
    {
        $this->request = $this->prophesize(Request::class);
        $this->routeMatcher = new RouteMatcher($this->request->reveal());
    }

    /**
     * @throws Exception
     */
    public function testYamlRouteMatchesRequest()
    {
        $this->request->getUriWithRemovedQueryString()->willReturn('test/any/route');
        $this->request->setParams([]);
        $route = new Route('test', 'test/any/route', 'Test', 'test');
        $collection = new Collection([$route]);
        $matchedRoute = $this->routeMatcher->match($collection);
        $this->assertEquals($route, $matchedRoute);
    }

    public function testYamlRouteWithParamsMatchesRequest()
    {
        $this->request->getUriWithRemovedQueryString()->willReturn('test/first/route/second');
        $this->request->setParams(['first', 'second']);
        $route = new Route('test', 'test/{any}/route/{param}', 'Test', 'test');
        $collection = new Collection([$route]);
        $matchedRoute = $this->routeMatcher->match($collection);
        $this->assertEquals($route, $matchedRoute);
    }

    /**
     * @throws Exception
     */
    public function testExceptionThrownIfNoMatchingRoute()
    {
        $this->expectException(NoMatchingRouteException::class);
        $routeMatcher = new RouteMatcher($this->request->reveal());
        $this->request->getUriWithRemovedQueryString()->willReturn('test/random');
        $this->request->setParams([]);
        $route = new Route('test', 'test/any/route', 'Test', 'test');
        $collection = new Collection([$route]);
        $routeMatcher->match($collection);
    }
}
