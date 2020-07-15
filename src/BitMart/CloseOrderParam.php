<?php


namespace BitMart;

/**
 * @param $contractId: Contract ID
 * @param $positionId: Position ID, you must send the position ID, otherwise invalid parameters are returned
 * @param $category: Order type 1: Limit order; 2: Market order
 * @param $way: Order side 2: Close short 3: Close long
 * @param $customId: The client's custom ID must be passed, otherwise it returns invalid parameters
 * @param $price: The price must meet the price accuracy requirements of the contract configuration,
 *                              and the accuracy is the contract configuration price precision multiplied by 10,
 *                              otherwise invalid request is returned
 * @param $vol: The quantity must meet the quantity precision configured by the contract,
 *                  otherwise invalid request is returned
 * @return array: ([response] =>stdClass, [httpCode] => 200, [limit] =>stdClass)
 */
class CloseOrderParam
{
    public $contract_id;
    public $position_id;
    public $category;
    public $way;
    public $custom_id;
    public $price;
    public $vol;

    /**
     * CloseOrderParam constructor.
     * @param $contract_id
     * @param $position_id
     * @param $category
     * @param $way
     * @param $custom_id
     * @param $price
     * @param $vol
     */
    public function __construct($contract_id, $position_id, $category, $way, $custom_id, $price, $vol)
    {
        $this->contract_id = $contract_id;
        $this->position_id = $position_id;
        $this->category = $category;
        $this->way = $way;
        $this->custom_id = $custom_id;
        $this->price = $price;
        $this->vol = $vol;
    }


}