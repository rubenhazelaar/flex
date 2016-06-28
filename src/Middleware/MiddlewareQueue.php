<?php

namespace Flex\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MiddlewareQueue implements MiddlewareQueueInterface
{
    protected $queue = array();

    public function register(array $queue): MiddlewareQueueInterface
    {
        $this->queue = $queue;
        return $this;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $entry = array_shift($this->queue);
        $middleware = $this->resolve($entry);
        return $middleware($request, $response, $this);
    }

    protected function resolve($entry)
    {
        if (!$entry) {
            // the default callable when the queue is empty
            return function (
                ServerRequestInterface $request,
                ResponseInterface $response,
                callable $next
            ) {
                return $response;
            };
        }

        return $entry;
    }
}