<?php

namespace BitMart;

use PHPUnit\Framework\TestCase;

class APISystemTest extends TestCase
{
    protected $APISystem;

    protected function setUp()
    {
        $this->APISystem = new APISystem(new CloudConfig(
            CloudConst::API_URL_TEST
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
