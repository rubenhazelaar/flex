<?php

namespace Flex\Template;

/**
 * Interface ViewModelInterface
 * @package Flex\Template
 *
 * A model implementing this interface should provide an array
 * where the keys and values form the properties of the template object
 *
 * @author Ruben Hazelaar <ruben.hazelaar@gmail.com>
 */
interface ViewModelInterface
{
    /**
     * Get array to use in a template
     * @return array
     */
    public function getData();
}