<?php

namespace Flex\Middleware;

use FastRoute;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouterMiddleware implements MiddlewareInterface
{
    const ACTION_ATTRIBUTE_NAME = 'rubenhazelaar/flex:router-action';
    const PARAMETERS_ATTRIBUTE_NAME = 'rubenhazelaar/flex:router-parameters';

    /**
     * @var FastRoute\Dispatcher
     */
    private $dispatcher;
    /**
     * @var string
     */
    private $actionAttributeName;
    /**
     * @var string
     */
    private $parametersAttributeName;

    public function __construct(
        FastRoute\Dispatcher $dispatcher,
        $actionAttributeName = self::ACTION_ATTRIBUTE_NAME,
        $parametersAttributeName = self::PARAMETERS_ATTRIBUTE_NAME
    )
    {
        $this->dispatcher = $dispatcher;
        $this->actionAttributeName = $actionAttributeName;
        $this->parametersAttributeName = $parametersAttributeName;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    )
    {
        $routeInfo = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                return $response->withStatus(404);
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                return $response->withStatus(405);
            case FastRoute\Dispatcher::FOUND:
                $action = $routeInfo[1];
                $parameters = $routeInfo[2];
                $request = $request
                    ->withAttribute($this->actionAttributeName, $action)
                    ->withAttribute($this->parametersAttributeName, $parameters);
                return $next($request, $response, $next);
            default:
                return $response->withStatus(500);
        }
    }
}