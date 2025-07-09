<?php
namespace Sx\Application\Middleware;

use Sx\Container\FactoryInterface;
use Sx\Container\Injector;
use Sx\Log\LogInterface;
use Sx\Message\Response\ResponseHelperInterface;

/**
 * The factory to create the error handler.
 */
class ErrorHandlerFactory implements FactoryInterface
{
    /**
     * Creates the error handler with the env provided by the global config.
     *
     * @param Injector $injector
     * @param array<mixed> $options
     * @param string $class
     *
     * @return ErrorHandler
     */
    public function create(Injector $injector, array $options, string $class): ErrorHandler
    {
        $helper = $injector->get(ResponseHelperInterface::class);
        assert($helper instanceof ResponseHelperInterface);
        $logger = $injector->get(LogInterface::class);
        assert($logger instanceof LogInterface);
        return new ErrorHandler($helper, $logger);
    }
}
