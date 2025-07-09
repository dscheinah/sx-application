<?php

namespace Sx\Application\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Add this middleware to your application or routes if you need to handle uploaded files from $_FILES.
 */
class UploadedFilesMiddleware implements MiddlewareInterface
{
    private UploadedFileFactoryInterface $uploadedFileFactory;

    private StreamFactoryInterface $streamFactory;

    /**
     * @var array<mixed>
     */
    private array $files;

    /**
     * Create the Middleware with factories and the source from $_FILES.
     *
     * @param UploadedFileFactoryInterface $uploadedFileFactory
     * @param StreamFactoryInterface $streamFactory
     * @param array<mixed> $files
     */
    public function __construct(
        UploadedFileFactoryInterface $uploadedFileFactory,
        StreamFactoryInterface $streamFactory,
        array $files
    ) {
        $this->uploadedFileFactory = $uploadedFileFactory;
        $this->streamFactory = $streamFactory;
        $this->files = $files;
    }

    /**
     * Parses the uploaded files and adds them to the request.
     *
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uploadedFiles = array_map(function ($file) {
            return $this->uploadedFileFactory->createUploadedFile(
                $this->streamFactory->createStreamFromFile($file['tmp_name']),
                $file['size'] ?? null,
                $file['error'] ?? null,
                $file['name'] ?? null,
                $file['type'] ?? null,
            );
        }, $this->files);
        return $handler->handle($request->withUploadedFiles($uploadedFiles));
    }
}
