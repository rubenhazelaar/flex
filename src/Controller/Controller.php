<?php

namespace Flex\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Controller implements ControllerInterface
{
    public function __construct(
        $context,
        ServerRequestInterface $request,
        ResponseInterface $response
    )
    {
        $this->context = $context;
        $this->request = $request;
        $this->response = $response;
    }
}