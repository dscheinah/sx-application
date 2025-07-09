<?php

namespace Sx\Application\Middleware;

use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Sx\Container\FactoryInterface;
use Sx\Container\Injector;

class UploadedFilesMiddlewareFactory implements FactoryInterface
{
    /**
     * Creates the middleware with the required psr message factories and the values from $_FILES.
     *
     * @param Injector $injector
     * @param array $options
     * @param string $class
     *
     * @return UploadedFilesMiddleware
     */
    public function create(Injector $injector, array $options, string $class): UploadedFilesMiddleware
    {
        return new UploadedFilesMiddleware(
            $injector->get(UploadedFileFactoryInterface::class),
            $injector->get(StreamFactoryInterface::class),
            $_FILES,
        );
    }
}
