<?php
namespace Sx\Application;

use Psr\Http\Server\MiddlewareInterface;
use Sx\Message\Response\ResponseHelperInterface;

/**
 * Base class for all app specific middlewares.
 */
abstract class MiddlewareAbstract implements MiddlewareInterface
{
    /**
     * Each middleware needs to create responses. The helper is a request builder for the expected content type.
     *
     * @var ResponseHelperInterface
     */
    protected $helper;

    /**
     * Requires the response helper to be given.
     *
     * @param ResponseHelperInterface $helper
     */
    public function __construct(ResponseHelperInterface $helper)
    {
        $this->helper = $helper;
    }
}
