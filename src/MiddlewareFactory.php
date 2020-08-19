<?php
namespace Sx\Application;

use Psr\Http\Server\MiddlewareInterface;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Message\Response\ResponseHelperInterface;

/**
 * A factory used by all middleware with just the requirements of MiddlewareAbstract.
 */
class MiddlewareFactory implements FactoryInterface
{
    /**
     * Creates a new middleware by given class name, providing the response helper.
     *
     * @param Injector $injector
     * @param array    $options
     * @param string   $class
     *
     * @return MiddlewareInterface
     */
    public function create(Injector $injector, array $options, string $class): MiddlewareInterface
    {
        return new $class($injector->get(ResponseHelperInterface::class));
    }
}
