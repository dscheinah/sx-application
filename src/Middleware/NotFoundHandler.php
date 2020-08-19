<?php
namespace Sx\Application\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sx\Application\HandlerAbstract;

/**
 * A very simple not found handler to be used at the end of a handle chain in the application.
 * It extends HandlerAbstract despite being a middleware as it is always the last chain element.
 */
class NotFoundHandler extends HandlerAbstract
{
    /**
     * Simply returns a not found response.
     *
     * @param ServerRequestInterface  $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->helper->create(404);
    }
}
