<?php

declare(strict_types=1);

error_reporting(-1); // Remove if you don't want error reporting 

require('../../vendor/autoload.php');

use Flex\Loader\PhpLoader;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response;

$queue = (new PhpLoader('../config/middleware.php'))->load();
$request = ServerRequestFactory::fromGlobals();
$response = $queue($request, new Response);
$emitter = new SapiEmitter;
$emitter->emit($response);