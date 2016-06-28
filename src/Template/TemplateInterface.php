<?php

namespace Flex\Template;

/**
 * Interface TemplateInterface
 * @package Flex\Template
 *
 * Implements a basic interface for template objects which output raw data
 */
interface TemplateInterface
{
    /**
     * Forms the starting point of the template rendering.
     *
     * This application MUST be implemented by the class or by it's parents
     *
     * @return void
     */
    public function start();

    /**
     * Adds data to the template object.
     *
     * @param $data
     * @return $this
     */
    public function add($data):TemplateInterface;

    /**
     * Adds data to the template object without regard to
     * restricted properties
     *
     * ONLY FOR INTERNAL USE!
     *
     * @param array $data
     * @return TemplateInterface
     */
    public function addRaw(array $data):TemplateInterface;

    /**
     * Triggers the rendering of the template(tree)
     *
     * @param bool|true $toString: Decides whether to render
     * to the output buffer or as a string
     * @return string|null|Psr\Http\Message\StreamInterface
     */
    public function render($toString = true);

    /**
     * Wraps render()
     * @return string
     */
    public function __toString();
}