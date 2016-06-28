<?php

namespace Flex\Test\Template;

class ViewModelTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $o = $this->getObjectForTrait('Flex\Template\ViewModelTrait');
        $o->one = 1;
        $o->two = 2;
        $this->assertEquals(array('one'=>1, 'two'=>2), $o->getData());
    }
}
