<?php

namespace Flex\Template;

/**
 * Class ViewModelTrait
 * @package Flex\Template
 * @see ViewModelInterface
 *
 * A simple trait which implements a very basic version of ViewModelInterface to extract
 * an array to use in a template which implements the TemplateInterface
 *
 * @author Ruben Hazelaar <ruben.hazelaar@gmail.com>
 */
trait ViewModelTrait
{
    /**
     * @inheritdoc
     */
    public function getData()
    {
        return get_object_vars($this);
    }
}