<?php

namespace BitMart\Tests;

use BitMart\Futures\APIContractSubAccount;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APIContractSubAccountTest extends TestCase
{
    protected $APIContractSubAccount;

    protected function setUp(): void
    {
        // Contract sub-account endpoints are served from the futures V2 host (api-cloud-v2.bitmart.com)
        $this->APIContractSubAccount = new APIContractSubAccount(TestConfig::getFuturesConfig());
    }

    public function testPostSubToMain()
    {
        $this->assertEquals(1000, $this->APIContractSubAccount->postSubToMain(
            'test-request-no-0005',
            '1',
            'USDT',
            'subAccountName'
        )['response']->code);
    }

    public function testPostMainToSub()
    {
        $this->assertEquals(1000, $this->APIContractSubAccount->postMainToSub(
            'test-request-no-0006',
            '1',
            'USDT',
            'subAccountName'
        )['response']->code);
    }

    public function testPostSubToMainForSub()
    {
        $this->assertEquals(1000, $this->APIContractSubAccount->postSubToMainForSub(
            'test-request-no-0007',
            '1',
            'USDT'
        )['response']->code);
    }

    public function testGetSubWallet()
    {
        $this->assertEquals(1000, $this->APIContractSubAccount->getSubWallet(
            'subAccountName',
            [
                'currency' => 'USDT',
            ]
        )['response']->code);
    }

    public function testGetSubTransferList()
    {
        $this->assertEquals(1000, $this->APIContractSubAccount->getSubTransferList(
            'subAccountName',
            100
        )['response']->code);
    }

    public function testGetSubTransferHistory()
    {
        $this->assertEquals(1000, $this->APIContractSubAccount->getSubTransferHistory(
            100
        )['response']->code);
    }

}
