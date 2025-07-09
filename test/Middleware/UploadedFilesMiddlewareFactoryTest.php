<?php

namespace Sx\ApplicationTest\Middleware;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Sx\Application\Middleware\UploadedFilesMiddlewareFactory;
use Sx\Container\Injector;

class UploadedFilesMiddlewareFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $this->expectNotToPerformAssertions();

        $injector = new Injector();
        $injector->set(UploadedFileFactoryInterface::class, $this->createMock(UploadedFileFactoryInterface::class));
        $injector->set(StreamFactoryInterface::class, $this->createMock(StreamFactoryInterface::class));

        $factory = new UploadedFilesMiddlewareFactory();
        $factory->create($injector, [], '');
    }
}
