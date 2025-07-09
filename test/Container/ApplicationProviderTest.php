<?php
namespace Sx\ApplicationTest\Container;

use Sx\Application\Container\ApplicationProvider;
use PHPUnit\Framework\TestCase;
use Sx\Application\Middleware\ErrorHandler;
use Sx\Application\Middleware\NotFoundHandler;
use Sx\Application\Middleware\UploadedFilesMiddleware;
use Sx\Container\Injector;

class ApplicationProviderTest extends TestCase
{
    public function testProvide(): void
    {
        $injector = new Injector();
        $provider = new ApplicationProvider();
        $provider->provide($injector);
        self::assertTrue($injector->has(ErrorHandler::class));
        self::assertTrue($injector->has(NotFoundHandler::class));
        self::assertTrue($injector->has(UploadedFilesMiddleware::class));
    }
}
