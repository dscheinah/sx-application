<?php
namespace Sx\Application;

use Psr\Http\Server\RequestHandlerInterface;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Message\Response\ResponseHelperInterface;

/**
 * A factory used by all handlers with just the requirements of HandlerAbstract.
 */
class HandlerFactory implements FactoryInterface
{
    /**
     * Creates a new handler by given class name, providing the response helper.
     *
     * @param Injector $injector
     * @param array    $options
     * @param string   $class
     *
     * @return RequestHandlerInterface
     */
    public function create(Injector $injector, array $options, string $class): RequestHandlerInterface
    {
        return new $class($injector->get(ResponseHelperInterface::class));
    }
}
