<?php

namespace BitMart;

use PHPUnit\Framework\TestCase;

class APIContractTest extends TestCase
{
    protected $APIContract;

    protected function setUp()
    {
        $this->APIContract = new APIContract(new CloudConfig(
            CloudConst::API_URL_TEST,
            "80618e45710812162b04892c7ee5ead4a3cc3e56",
            "6c6c98544461bbe71db2bca4c6d7fd0021e0ba9efc215f9c6ad41852df9d9df9",
            "test001"
        ));
    }

    public function testGetContracts()
    {
        $this->assertEquals(1000, $this->APIContract->getContracts()['response']->code);
    }

    public function testGetPnls()
    {
        $this->assertEquals(1000, $this->APIContract->getPnls(1)['response']->code);
    }

    public function testGetIndex()
    {
        $this->assertEquals(1000, $this->APIContract->getIndex()['response']->code);
    }

    public function testGetTicker()
    {
        $this->assertEquals(1000, $this->APIContract->getTicker(1)['response']->code);
    }

    public function testGetAllTicker()
    {
        $this->assertEquals(1000, $this->APIContract->getAllTicker()['response']->code);
    }

    public function testGetQuote()
    {
        $this->assertEquals(1000, $this->APIContract->getQuote(
            1,
            1584343602,
            1585343602,
            5,
            'M'
        )['response']->code);
    }

    public function testGetIndexQuote()
    {
        $this->assertEquals(1000, $this->APIContract->getIndexQuote(
            1,
            1584343602,
            1585343602,
            5,
            'M'
        )['response']->code);
    }

    public function testGetTrades()
    {
        $this->assertEquals(1000, $this->APIContract->getTrades(1)['response']->code);
    }

    public function testGetDepth()
    {
        $this->assertEquals(1000, $this->APIContract->getDepth(
            1,
            null // Or 1,2,3...
        )['response']->code);
    }

    public function testGetFundingRate()
    {
        $this->assertEquals(1000, $this->APIContract->getFundingRate(1)['response']->code);
    }

    public function testGetUserOrders()
    {
        $this->assertEquals(1000, $this->APIContract->getUserOrders(
            1,
        0,
        null,
        null
        )['response']->code);
    }


    public function testGetUserOrderInfo()
    {
        $this->assertEquals(1000, $this->APIContract->getUserOrderInfo(
            1,
            3848688617
        )['response']->code);
    }

    public function testGetUserTrades()
    {
        $this->assertEquals(1000, $this->APIContract->getUserTrades(
            1,
            1,
            10
        )['response']->code);
    }

    public function testGetOrderTrades()
    {
        $this->assertEquals(1000, $this->APIContract->getOrderTrades(
            1,
            3844380442
        )['response']->code);
    }


    public function testPostSubmitOpenOrder()
    {
        $this->assertEquals(1000, $this->APIContract->postSubmitOpenOrder(new OpenOrderParam(
            1,
            1,
            4,
            100,
            1,
            10,
            9200,
            10
        ))['response']->code);
    }

    public function testPostSubmitBatchOpenOrder()
    {
        $openOrderArrayParam = array();

        $openOrderArrayParam[] = new OpenOrderParam(
            1,
            1,
            4,
            100,
            1,
            10,
            9200,
            10
        );

        $openOrderArrayParam[] = new OpenOrderParam(
            1,
            1,
            4,
            100,
            1,
            10,
            9200,
            10
        );

        $this->assertEquals(1000, $this->APIContract->postSubmitBatchOpenOrder($openOrderArrayParam)['response']->code); // 3848678249
    }

    public function testPostSubmitCloseOrder()
    {
        $this->assertEquals(1000, $this->APIContract->postSubmitCloseOrder(new CloseOrderParam(
            1,
            1,
            1,
            2,
            1,
            9200,
            10
        ))['response']->code);
    }

    public function testPostSubmitBatchCloseOrder()
    {
        $closeOrderArrayParam = array();

        $closeOrderArrayParam[] = new CloseOrderParam(
            1,
            1,
            2,
            100,
            1,
            9200,
            10
        );

        $closeOrderArrayParam[] = new CloseOrderParam(
            1,
            1,
            2,
            100,
            1,
            9200,
            10
        );

        $this->assertEquals(1000, $this->APIContract->postSubmitBatchCloseOrder($closeOrderArrayParam)['response']->code); // 3848678249
    }


    public function testPostCancelOrder()
    {
        $this->assertEquals(1000, $this->APIContract->postCancelOrder(1, [3848690372, 3848690373])['response']->code);
    }

    public function testGetAccount()
    {
        $this->assertEquals(1000, $this->APIContract->getAccount('USDT')['response']->code);
    }


    public function testGetUserPositions()
    {
        $this->assertEquals(1000, $this->APIContract->getUserPositions(1)['response']->code);
    }

    public function testGetUserLiqRecords()
    {
        $this->assertEquals(1000, $this->APIContract->getUserLiqRecords(1, 3848690372)['response']->code);
    }


    public function testGetPositionFee()
    {
        $this->assertEquals(1000, $this->APIContract->getPositionFee(1, 1)['response']->code);
    }

    public function testPostMarginOper()
    {
        $this->assertEquals(1000, $this->APIContract->postMarginOper(1, 1219313, 100, 1)['response']->code);
    }

}
