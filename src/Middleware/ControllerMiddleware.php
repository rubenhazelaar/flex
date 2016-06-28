<?php

namespace Flex\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ControllerMiddleware implements MiddlewareInterface
{
    /**
     * ControllerMiddleware constructor.
     */
    public function __construct($context = null)
    {
        $this->context = $context;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $action = $request->getAttribute(RouterMiddleware::ACTION_ATTRIBUTE_NAME);
        $parameters = $request->getAttribute(RouterMiddleware::PARAMETERS_ATTRIBUTE_NAME);

        if(!$action) {
            throw new \RuntimeException('Can\'t invoke controller, please check if RouterMiddleware & ControllerMiddleware are configured correctly');
        }

        // Instantiate controller and call
        if (is_array($action)) {
            $action[0] = new $action[0]($this->context, $request, $response);
            return $action[0]->{$action[1]}(...array_values($parameters));
        }

        // Try to call any other way
        return call_user_func_array($action, $parameters);
    }
}