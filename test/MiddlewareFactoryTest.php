<?php
namespace Sx\ApplicationTest;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Sx\Application\MiddlewareFactory;
use Sx\ApplicationTest\Mock\Middleware;
use Sx\Container\Injector;
use Sx\Message\Response\JsonFactory;
use Sx\Message\Response\ResponseHelperInterface;
use Sx\Message\ResponseFactory;
use Sx\Message\StreamFactory;

class MiddlewareFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $injector = new Injector();
        $injector->set(ResponseHelperInterface::class, JsonFactory::class);
        $injector->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $injector->set(StreamFactoryInterface::class, StreamFactory::class);
        $factory = new MiddlewareFactory();
        $factory->create($injector, [], Middleware::class);
        self::assertTrue(true);
    }
}
