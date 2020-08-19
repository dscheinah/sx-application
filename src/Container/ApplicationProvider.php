<?php
namespace Sx\Application\Container;

use Sx\Application\HandlerFactory;
use Sx\Application\Middleware\ErrorHandler;
use Sx\Application\Middleware\ErrorHandlerFactory;
use Sx\Application\Middleware\NotFoundHandler;
use Sx\Container\Injector;
use Sx\Container\ProviderInterface;

/**
 * A configuration provider for the dependency injection container.
 */
class ApplicationProvider implements ProviderInterface
{
    /**
     * Registers the default factories for all classes used in this module.
     *
     * @param Injector $injector
     */
    public function provide(Injector $injector): void
    {
        $injector->set(ErrorHandler::class, ErrorHandlerFactory::class);
        $injector->set(NotFoundHandler::class, HandlerFactory::class);
    }
}
