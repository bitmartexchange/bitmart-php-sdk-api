<?php

namespace BitMart\Tests;

use BitMart\Spot\APISystem;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;



class APISystemTest extends TestCase
{
    protected $APISystem;

    protected function setUp(): void
    {
        $this->APISystem = new APISystem(TestConfig::getSpotConfig());
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
