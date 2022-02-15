<?php

namespace BitMart;

use PHPUnit\Framework\TestCase;

class APIContractTest extends TestCase
{
    protected $APIContract;

    protected function setUp()
    {
        $this->APIContract = new APIContract(new CloudConfig(
            CloudConst::API_URL_PRO,
            "80618e45710812162b04892c7ee5ead4a3cc3e56",
            "6c6c98544461bbe71db2bca4c6d7fd0021e0ba9efc215f9c6ad41852df9d9df9",
            "test001"
        ));
    }

    public function testGetContracts()
    {
        $this->assertEquals(1000, $this->APIContract->getTickers()['response']->code);
    }


}
