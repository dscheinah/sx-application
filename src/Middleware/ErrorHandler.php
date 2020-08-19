<?php
namespace Sx\Application\Middleware;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Sx\Application\MiddlewareAbstract;
use Sx\Log\LogInterface;
use Sx\Message\Response\ResponseHelperInterface;

/**
 * The error handler to create error responses out of exceptions.
 */
class ErrorHandler extends MiddlewareAbstract
{
    /**
     * The logger to write errors to.
     *
     * @var LogInterface
     */
    private $logger;

    /**
     * Create the error handler with helper and env from config.
     *
     * @param ResponseHelperInterface $helper
     * @param LogInterface            $logger
     */
    public function __construct(ResponseHelperInterface $helper, LogInterface $logger)
    {
        parent::__construct($helper);
        $this->logger = $logger;
    }

    /**
     * Wraps the call to the next handler in a try/ catch block and creates error responses.
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     *
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Exception $e) {
            $this->logger->log($e->getMessage());
            // Do not output any internal information for production environment.
            return $this->helper->create(500);
        }
    }
}
