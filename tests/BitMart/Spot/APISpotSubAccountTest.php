<?php

namespace BitMart\Tests;

use BitMart\Spot\APISpotSubAccount;
use BitMart\Tests\TestConfig;
use PHPUnit\Framework\TestCase;

class APISpotSubAccountTest extends TestCase
{
    protected $APISpotSubAccount;

    protected function setUp(): void
    {
        $this->APISpotSubAccount = new APISpotSubAccount(TestConfig::getSpotConfig());
    }

    public function testPostSubToMain()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->postSubToMain(
            'test-request-no-0001',
            '1',
            'USDT',
            'subAccountName'
        )['response']->code);
    }

    public function testPostSubToMainForSub()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->postSubToMainForSub(
            'test-request-no-0002',
            '1',
            'USDT'
        )['response']->code);
    }

    public function testPostMainToSub()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->postMainToSub(
            'test-request-no-0003',
            '1',
            'USDT',
            'subAccountName'
        )['response']->code);
    }

    public function testPostSubToSub()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->postSubToSub(
            'test-request-no-0004',
            '1',
            'USDT',
            'fromSubAccount',
            'toSubAccount'
        )['response']->code);
    }

    public function testGetSubTransferList()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->getSubTransferList(
            'spot to spot',
            100,
            [
                'accountName' => 'subAccountName',
            ]
        )['response']->code);
    }

    public function testGetSubTransferHistory()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->getSubTransferHistory(
            'spot to spot',
            100
        )['response']->code);
    }

    public function testGetSubWallet()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->getSubWallet(
            'subAccountName',
            [
                'currency' => 'USDT',
            ]
        )['response']->code);
    }

    public function testGetSubAccountList()
    {
        $this->assertEquals(1000, $this->APISpotSubAccount->getSubAccountList()['response']->code);
    }

}
