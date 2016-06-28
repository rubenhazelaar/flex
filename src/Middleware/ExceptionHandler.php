<?php

namespace Flex\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExceptionHandler
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        try {
            $response = $next($request, $response);
        } catch (\Exception $e) {
            $response = $response->withStatus(500);
            $response->getBody()->write('Exception caught with message: ' . $e->getMessage());
        }
        return $response;
    }
}