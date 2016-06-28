<?php

namespace ACME\Template;

use Flex\Template\TemplateInterface;
use Flex\Template\TemplateTrait;

class Base implements TemplateInterface
{
    use TemplateTrait;

    public function start()
    { ?>
        <style>
            html {
                font-family: sans-serif;
            }
        </style>
        <h1>Flex</h1>
        <?php $this->partial('content'); ?>
        <?php $this->partial('footer'); ?>
    <?php }

    protected function footer()
    { ?>
        <footer>Copyright <?php echo date('Y'); ?></footer>
    <?php }
}