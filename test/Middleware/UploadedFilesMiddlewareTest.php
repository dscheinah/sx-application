<?php

namespace Sx\ApplicationTest\Middleware;

use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileFactoryInterface;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Application\Middleware\UploadedFilesMiddleware;
use PHPUnit\Framework\TestCase;

class UploadedFilesMiddlewareTest extends TestCase
{
    private const FILES = [
        'key' => [
            'tmp_name' => 'test-tmp-name',
            'size' => 42,
            'error' => UPLOAD_ERR_FORM_SIZE,
            'name' => 'test-name',
            'type' => 'test-type',
        ],
    ];

    private UploadedFilesMiddleware $middleware;

    private MockObject $uploadedFileFactoryMock;

    private MockObject $streamFactoryMock;

    private MockObject $uploadedFileMock;

    private MockObject $streamMock;

    private MockObject $requestMock;

    private MockObject $handlerMock;

    private MockObject $responseMock;

    protected function setUp(): void
    {
        $this->uploadedFileFactoryMock = $this->createMock(UploadedFileFactoryInterface::class);
        $this->streamFactoryMock = $this->createMock(StreamFactoryInterface::class);
        $this->middleware = new UploadedFilesMiddleware(
            $this->uploadedFileFactoryMock,
            $this->streamFactoryMock,
            self::FILES,
        );

        $this->uploadedFileMock = $this->createMock(UploadedFileInterface::class);
        $this->streamMock = $this->createMock(StreamInterface::class);

        $this->requestMock = $this->createMock(ServerRequestInterface::class);
        $this->handlerMock = $this->createMock(RequestHandlerInterface::class);
        $this->responseMock = $this->createMock(ResponseInterface::class);
    }

    public function testProcess(): void
    {
        $this->uploadedFileFactoryMock
            ->expects(self::once())
            ->method('createUploadedFile')
            ->with(
                $this->streamMock,
                self::FILES['key']['size'],
                self::FILES['key']['error'],
                self::FILES['key']['name'],
                self::FILES['key']['type'],
            )
            ->willReturn($this->uploadedFileMock);

        $this->streamFactoryMock
            ->expects(self::once())
            ->method('createStreamFromFile')
            ->with(self::FILES['key']['tmp_name'])
            ->willReturn($this->streamMock);

        $this->requestMock
            ->expects(self::once())
            ->method('withUploadedFiles')
            ->with(['key' => $this->uploadedFileMock])
            ->willReturn($this->requestMock);

        $this->handlerMock
            ->expects(self::once())
            ->method('handle')
            ->with($this->requestMock)
            ->willReturn($this->responseMock);

        $response = $this->middleware->process($this->requestMock, $this->handlerMock);
        self::assertSame($this->responseMock, $response);
    }
}
