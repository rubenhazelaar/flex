<?php

namespace ACME\Template;

use Flex\Template\TemplateInterface;
use Flex\Template\TemplateTrait;

class About extends Index
{
    public function content()
    { ?>
        <h2>About: <?php echo $this->escape($this->name); ?></h2>
    <?php }
}