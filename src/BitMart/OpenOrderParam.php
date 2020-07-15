<?php


namespace BitMart;

/**
 * Class OpenOrder
 * @param $category:Order type 1: Limit order; 2: Market order
 * @param $way: Order side 1: Open long 4: Open short
 * @param $customId: The client's custom ID must be passed, otherwise it returns invalid parameters
 * @param $openType: Open type 1: Cross margin; 2: Fixed margin
 * @param $leverage: Leverage must meet the effective range of leverage configured in the contract,
 *                          otherwise invalid parameters are returned
 * @param $price: The price must meet the price accuracy requirements of the contract configuration,
 *                              and the accuracy is the contract configuration price precision multiplied by 10,
 *                              otherwise invalid request is returned
 * @param $vol: The quantity must meet the quantity precision configured by the contract,
 *                  otherwise invalid request is returned
 * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
 */
class OpenOrderParam
{
    public $contract_id;
    public $category;
    public $way;
    public $custom_id;
    public $open_type;
    public $leverage;
    public $price;
    public $vol;

    public function __construct($contractId, $category, $way, $customId, $openType, $leverage, $price, $vol)
    {
        $this->contract_id = $contractId;
        $this->category = $category;
        $this->way = $way;
        $this->custom_id = $customId;
        $this->open_type = $openType;
        $this->leverage = $leverage;
        $this->price = $price;
        $this->vol = $vol;
    }
}