<?php
namespace Sx\ApplicationTest\Mock;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sx\Application\HandlerAbstract;
use Sx\Message\Response;

class Handler extends HandlerAbstract
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response();
    }
}
