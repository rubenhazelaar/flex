<?php

namespace Flex\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface MiddlewareQueueInterface
{
    public function register(array $queue): MiddlewareQueueInterface;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response);
}