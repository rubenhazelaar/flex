<?php

namespace ACME\Controller;

use ACME\Template\About as TemplateAbout;
use ACME\Template\Index as TemplateIndex;
use Flex\Controller\Controller;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Stream;

class Index extends Controller
{
    public function index()
    {
        $home = new TemplateIndex;
        $home->setStream(new Stream('php://temp', 'wb+'));
        $home->add(['introduction' => 'Flex is an ultra simple framework.']);

        return new HtmlResponse($home->render());
    }

    public function about($name = '[Enter your name in the URL after "/about" e.g. "/about/flex"]')
    {
        $about = new TemplateAbout;
        $about->setStream(new Stream('php://temp', 'wb+'));
        $about->add(['name' => $name]);

        return new HtmlResponse($about->render());
    }
}