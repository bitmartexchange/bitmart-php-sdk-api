<?php

namespace BitMart;

use PHPUnit\Framework\TestCase;

class CloudUtilTest extends TestCase
{
    public function testGetTimestamp()
    {
        $time = CloudUtil::getTimestamp();
        echo 'time:' . $time;
        $this->assertIsBool("" != $time);
    }

    public function testSignature()
    {
        $sign = CloudUtil::signature("1589793795969", "symbol=BTC_USDT",
            new CloudConfig("", "", "6c6c98544461bbe71db2bca4c6d7fd0021e0ba9efc215f9c6ad41852df9d9df9", "test001"));
        echo '$sign:' . $sign;
        $this->assertIsBool("" != $sign);
    }
}
