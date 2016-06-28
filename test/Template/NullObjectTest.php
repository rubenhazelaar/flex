<?php

namespace Flex\Test\Template;

use Flex\Template\NullObject;
use SebastianBergmann\Comparator\ComparisonFailure;

class NullObjectTest extends \PHPUnit_Framework_TestCase
{
    private $nullObject;

    public function setUp()
    {
        $this->nullObject = new NullObject();
    }

    public function testInterface()
    {
        $this->assertInstanceOf('\ArrayAccess',$this->nullObject);
        $this->assertInstanceOf('\IteratorAggregate',$this->nullObject);
        $this->assertInstanceOf('\Serializable',$this->nullObject);
        $this->assertInstanceOf('\Countable',$this->nullObject);
    }

    public function testPropertySet()
    {
        $e = null;
        try {
            $this->nullObject->test = 'test';
        } catch (ComparisonFailure $e) {
        }

        $this->testSetState();

        $this->assertNull($e, 'Unexpected ComparisonFailure');
    }

    public function testPropertyGet()
    {
        $this->assertEmpty($this->nullObject->test);
    }

    public function testSetState()
    {
        $this->assertEquals('Flex\Template\NullObject::__set_state(array())'
            , preg_replace('/\s+/', '', var_export($this->nullObject, true)));
    }

    /**
     * @TODO: Create better test, if this test fails it creates a fatal_error
     */
    public function testCall()
    {
        $e = null;
        try {
            $this->nullObject->test();
        } catch (ComparisonFailure $e) {
        }

        $this->assertNull($e, 'Unexpected ComparisonFailure');
    }

    /**
     * @TODO: Create better test, if this test fails it creates a fatal_error
     */
    public function testStaticCall()
    {
        $e = null;
        try {
            NullObject::test();
        } catch (ComparisonFailure $e) {
        }

        $this->assertNull($e, 'Unexpected ComparisonFailure');
    }

    public function testToString()
    {
        $this->assertEmpty((string)$this->nullObject);
    }

    /**
     * @TODO: Create better test, if this test fails it creates a fatal_error
     */
    public function testInvoke()
    {
        $e = null;
        try {
            $nO = $this->nullObject;
            $nO();
        } catch (ComparisonFailure $e) {
        }

        $this->assertNull($e, 'Unexpected ComparisonFailure');
    }

    public function testOffsetGet()
    {
        $this->nullObject->test = 'test';
        $this->assertEmpty($this->nullObject['test']);
    }

    public function tesOffsetSet()
    {
        $e = null;
        try {
            $this->nullObject->test = 'test';
        } catch (ComparisonFailure $e) {
        }

        $this->testSetState();

        $this->assertNull($e, 'Unexpected ComparisonFailure');
    }

    public function testIterator()
    {
        $i = 0;
        foreach ($this->nullObject as $v) {
            $i++;
        }

        $this->assertEmpty($i);
    }

    public function testSerializable()
    {
        $this->test = 'test';
        $this->assertEquals('N;', serialize($this->nullObject));
    }

    public function testCountable()
    {
        $this->assertEmpty(count($this->nullObject));
    }
}