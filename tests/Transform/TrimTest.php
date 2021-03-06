<?php namespace ApishkaTest\Transformer\Transform;

use Apishka\Transformer\Transform\Trim;

/**
 * Trim sanitizer test
 */

class TrimTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepare assert
     *
     * @return Trim
     */

    protected function prepareSanitizer()
    {
        return new Trim();
    }

    /**
     * Test integer
     */

    public function testInteger()
    {
        $this->assertSame(
            '10',
            $this->prepareSanitizer()->process(10)
        );
    }

    /**
     * Test null
     */

    public function testNull()
    {
        $this->assertNull(
            $this->prepareSanitizer()->process(null)
        );
    }

    /**
     * Test object
     *
     * @expectedException        \Apishka\Transformer\Exception
     * @expectedExceptionMessage wrong input format
     */

    public function testObject()
    {
        $this->prepareSanitizer()->process(new \StdClass());
    }

    /**
     * Test array
     *
     * @expectedException        \Apishka\Transformer\Exception
     * @expectedExceptionMessage wrong input format
     */

    public function testArray()
    {
        $this->prepareSanitizer()->process(array(1));
    }

    /**
     * Test right trim
     */

    public function testRightTrim()
    {
        $this->assertSame(
            'test',
            $this->prepareSanitizer()->process('test ')
        );
    }

    /**
     * Test left trim
     */

    public function testLeftTrim()
    {
        $this->assertSame(
            'test',
            $this->prepareSanitizer()->process(' test')
        );
    }

    /**
     * Test left trim
     */

    public function testTrim()
    {
        $this->assertSame(
            'test',
            $this->prepareSanitizer()->process(' test ')
        );
    }
}
