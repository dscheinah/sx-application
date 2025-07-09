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
     * @param array<mixed> $options
     * @param string $class
     *
     * @return UploadedFilesMiddleware
     */
    public function create(Injector $injector, array $options, string $class): UploadedFilesMiddleware
    {
        $uploadedFileFactory = $injector->get(UploadedFileFactoryInterface::class);
        assert($uploadedFileFactory instanceof UploadedFileFactoryInterface);
        $streamFactory = $injector->get(StreamFactoryInterface::class);
        assert($streamFactory instanceof StreamFactoryInterface);
        return new UploadedFilesMiddleware(
            $uploadedFileFactory,
            $streamFactory,
            $_FILES,
        );
    }
}
