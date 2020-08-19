<?php

namespace Sx\ApplicationTest\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Sx\Application\Middleware\ErrorHandler;
use Sx\Application\Middleware\ErrorHandlerFactory;
use PHPUnit\Framework\TestCase;
use Sx\ApplicationTest\Mock\Log;
use Sx\Container\Injector;
use Sx\Log\LogInterface;
use Sx\Message\Response\JsonFactory;
use Sx\Message\Response\ResponseHelperInterface;
use Sx\Message\ResponseFactory;
use Sx\Message\StreamFactory;

class ErrorHandlerFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $injector = new Injector();
        $injector->set(ResponseHelperInterface::class, JsonFactory::class);
        $injector->set(LogInterface::class, Log::class);
        $injector->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $injector->set(StreamFactoryInterface::class, StreamFactory::class);
        $factory = new ErrorHandlerFactory();
        $factory->create($injector, [], ErrorHandler::class);
        self::assertTrue(true);
    }
}
