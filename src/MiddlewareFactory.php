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
     * Creates new middleware by given class name, providing the response helper.
     *
     * @param Injector $injector
     * @param array<mixed> $options
     * @param class-string<MiddlewareInterface> $class
     *
     * @return MiddlewareInterface
     */
    public function create(Injector $injector, array $options, string $class): MiddlewareInterface
    {
        $responseHelper = $injector->get(ResponseHelperInterface::class);
        assert($responseHelper instanceof ResponseHelperInterface);
        return new $class($responseHelper);
    }
}
