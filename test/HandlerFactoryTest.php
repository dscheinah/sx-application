<?php
namespace Sx\ApplicationTest;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Sx\Application\HandlerFactory;
use PHPUnit\Framework\TestCase;
use Sx\ApplicationTest\Mock\Handler;
use Sx\Container\Injector;
use Sx\Message\Response\JsonFactory;
use Sx\Message\Response\ResponseHelperInterface;
use Sx\Message\ResponseFactory;
use Sx\Message\StreamFactory;

class HandlerFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $injector = new Injector();
        $injector->set(ResponseHelperInterface::class, JsonFactory::class);
        $injector->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $injector->set(StreamFactoryInterface::class, StreamFactory::class);
        $factory = new HandlerFactory();
        $factory->create($injector, [], Handler::class);
        self::assertTrue(true);
    }
}
