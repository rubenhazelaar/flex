<?php

namespace ACME\Template;

use Flex\Template\TemplateInterface;
use Flex\Template\TemplateTrait;

class Index extends Base
{
    public $introduction = ''; // This value can/will be overridden

    public function content()
    { ?>
        <h2>Index</h2>
        <p><?php echo $this->introduction; ?></p>
    <?php }
}