<?php namespace ApishkaTest\Transformer\Transform;

use Apishka\Transformer\Transform\Callback;

/**
 * Callback assert test
 */

class CallbackTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Prepare assert
     *
     * @return Callback
     */

    protected function prepareAssert()
    {
        return new Callback();
    }

    /**
     * Test integer
     */

    public function testInteger()
    {
        $this->assertSame(
            10,
            $this->prepareAssert()->process(
                10,
                [
                    'callback' => function ($value)
                    {
                        if ($value !== 10)
                            throw new \Exception();
                    },
                ]
            )
        );
    }

    /**
     * Test no callback
     *
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Property "callback" not found in options
     */

    public function testNoCallback()
    {
        $this->prepareAssert()->process(10);
    }

    /**
     * Test bad callback
     *
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage Property "callback" is not function
     */

    public function testBadCallback()
    {
        $this->prepareAssert()->process(
            10,
            [
                'callback' => 10,
            ]
        );
    }

    /**
     * Test callback
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage wrong value
     */

    public function testCallback()
    {
        $this->prepareAssert()->process(
            9,
            [
                'callback' => function ($value)
                {
                    if ($value !== 10)
                        throw new \Exception('wrong value');
                },
            ]
        );
    }

    /**
     * Test returning
     */

    public function testReturning()
    {
        $this->assertSame(
            20,
            $this->prepareAssert()->process(
                10,
                [
                    'returning' => true,
                    'callback'  => function ($value)
                    {
                        return $value + 10;
                    },
                ]
            )
        );
    }
}
