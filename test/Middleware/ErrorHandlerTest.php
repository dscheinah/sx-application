<?php
namespace Sx\ApplicationTest\Middleware;

use Sx\Application\Middleware\ErrorHandler;
use PHPUnit\Framework\TestCase;
use Sx\ApplicationTest\Mock\Log;
use Sx\ApplicationTest\Mock\RequestHandler;
use Sx\Message\Response\Json;
use Sx\Message\ResponseFactory;
use Sx\Message\ServerRequest;
use Sx\Message\StreamFactory;

class ErrorHandlerTest extends TestCase
{
    public function testProcess(): void
    {
        $logger = new Log();
        $middleware = new ErrorHandler(new Json(new ResponseFactory(), new StreamFactory()), $logger);
        $response = $middleware->process(new ServerRequest(), new RequestHandler());
        self::assertEquals(500, $response->getStatusCode());
        self::assertNotEmpty($logger->logged);
    }
}
