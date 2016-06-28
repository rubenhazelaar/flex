<?php

use Flex\Middleware\MiddlewareQueue;
use Flex\Middleware\RouterMiddleware;
use Flex\Loader\PhpLoader;
use Flex\Middleware\ControllerMiddleware;
use Flex\Middleware\ExceptionHandler;

return (new MiddlewareQueue)->register([
    new ExceptionHandler,
    new RouterMiddleware(
        (new PhpLoader(__DIR__ . '/routes.php'))->load()
    ),
    // Should always be used as last middleware
    // Depends on RouterMiddleware
    new ControllerMiddleware
]);

