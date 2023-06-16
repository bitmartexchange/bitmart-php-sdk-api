<?php

namespace BitMart\Param;



/**
 * Class ContractPlanOrderParam
 * @package BitMart\Param
 */
class ContractPlanOrderParam
{

    /**
     * Symbol of the contract(like BTCUSDT)
     * @var mixed|null
     */
    public $symbol;



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
     * Order size (Number of contracts)
     * @var mixed|null
     */
    public $size;

    /**
     * Trigger price
     * @var
     */
    public $trigger_price;

    /**
     * Order price, required at limit order
     * @var
     */
    public $executive_price;

    /**
     * Price way
     *  -1=price_way_long
     *  -2=price_way_short
     * @var  1/2
     */
    public $price_way;

    /**
     * Trigger price type
     *      -1=last_price
     *      -2=fair_price
     * @var  1/2
     */
    public $price_type;



    public function __construct($args = array())
    {
        $this->symbol             = $args['symbol'] ?? null;
        $this->type               = $args['type'] ?? null;
        $this->side               = $args['side'] ?? null;
        $this->leverage           = $args['leverage'] ?? null;
        $this->open_type          = $args['openType'] ?? null;
        $this->mode           = $args['mode'] ?? null;
        $this->size           = $args['size'] ?? null;
        $this->trigger_price          = $args['triggerPrice'] ?? null;
        $this->executive_price          = $args['executivePrice'] ?? null;
        $this->price_way          = $args['priceWay'] ?? null;
        $this->price_type          = $args['priceType'] ?? null;
    }

}