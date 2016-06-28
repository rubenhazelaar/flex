<?php

namespace Flex\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{
    public function __construct(
        $context,
        ServerRequestInterface $request,
        ResponseInterface $response
    );
}