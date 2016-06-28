<?php

use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std as RouteParser;
use FastRoute\DataGenerator\GroupCountBased as RouteGenerator;
use FastRoute\Dispatcher\GroupCountBased as Dispatcher;

$r = new RouteCollector(
    new RouteParser, new RouteGenerator
);

$r->addRoute('GET', '/', ['ACME\Controller\Index','index']);
$r->addRoute('GET', '/about[/{name}]', ['ACME\Controller\Index','about']);

return new Dispatcher($r->getData());
