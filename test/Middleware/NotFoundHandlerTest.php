<?php
namespace Sx\ApplicationTest\Middleware;

use Sx\Application\Middleware\NotFoundHandler;
use PHPUnit\Framework\TestCase;
use Sx\Message\Response\Json;
use Sx\Message\ResponseFactory;
use Sx\Message\ServerRequest;
use Sx\Message\StreamFactory;

class NotFoundHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $handler = new NotFoundHandler(new Json(new ResponseFactory(), new StreamFactory()));
        $response = $handler->handle(new ServerRequest());
        self::assertEquals(404, $response->getStatusCode());
    }
}
