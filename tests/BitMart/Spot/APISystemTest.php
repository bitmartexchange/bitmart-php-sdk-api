<?php

namespace BitMart\Tests;

use BitMart\Lib\CloudConfig;
use BitMart\Spot\APISystem;
use PHPUnit\Framework\TestCase;



class APISystemTest extends TestCase
{
    protected $APISystem;

    protected function setUp()
    {
        $this->APISystem = new APISystem(new CloudConfig(
            [
                'timeoutSecond'  => 5,
                'xdebug'  => true,
            ]
        ));
    }

    public function testGetSystemTime()
    {
        $this->assertEquals(1000, $this->APISystem->getSystemTime()['response']->code);
    }

    public function testGetSystemService()
    {
        $this->assertEquals(1000, $this->APISystem->getSystemService()['response']->code);
    }


}
