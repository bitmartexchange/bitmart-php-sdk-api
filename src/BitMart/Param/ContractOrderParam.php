<?php

namespace BitMart\Param;



/**
 * Class ContractOrderParam
 * @package BitMart\Param
 */
class ContractOrderParam
{

    /**
     * Symbol of the contract(like BTCUSDT)
     * @var mixed|null
     */
    public $symbol;

    /**
     * Client-defined OrderId(A combination of numbers and letters, less than 32 bits)
     * @var mixed|null
     */
    public $client_order_id;

    /**
     * limit(default)/market
     *
     * @var limit/market
     */
    public $type;


    /**
     * Order side
     *      -1=buy_open_long
     *      -2=buy_close_short
     *      -3=sell_close_long
     *      -4=sell_open_short
     * @var 1/2/3/4
     */
    public $side;

    /**
     * Order leverage
     * @var 1
     */
    public $leverage;

    /**
     * Open type, required at close position
     * @var cross/isolated
     */
    public $open_type;

    /**
     * Order mode
     *      -1=GTC(default)
     *      -2=FOK
     *      -3=IOC
     *      -4=Maker Only
     * @var 1/2/3/4
     */
    public $mode;

    /**
     * Order price, required at limit order
     * @var mixed|null
     */
    public $price;

    /**
     * Order size (Number of contracts)
     * @var mixed|null
     */
    public $size;




    public function __construct($args = array())
    {
        $this->symbol             = $args['symbol'] ?? null;
        $this->client_order_id    = $args['clientOrderId'] ?? null;
        $this->type               = $args['type'] ?? null;
        $this->side               = $args['side'] ?? null;
        $this->leverage           = $args['leverage'] ?? null;
        $this->open_type          = $args['openType'] ?? null;
        $this->mode           = $args['mode'] ?? null;
        $this->size           = $args['size'] ?? null;
        $this->price          = $args['price'] ?? null;
    }

}