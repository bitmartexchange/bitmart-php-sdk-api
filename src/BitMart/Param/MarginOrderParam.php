<?php

namespace BitMart\Param;



/**
 * Class MarginOrderParam
 * @package BitMart\Param
 */
class MarginOrderParam
{

    /**
     * Trading pair (e.g. BTC_USDT)
     * @var mixed|null
     */
    public $symbol;

    /**
     *  buy/sell
     * @var mixed|null
     */
    public $side;

    /**
     * limit/market/limit_maker/ioc
     *
     * @var mixed|null
     */
    public $type;

    /**
     * Order size | Quantity sold, required when selling at market price size
     * @var mixed|null
     */
    public $size;

    /**
     * Order Price
     * @var mixed|null
     */
    public $price;

    /**
     * Quantity bought, required when buying at market price
     * @var mixed|null
     */
    public $notional;

    /**
     * Client-defined OrderId(A combination of numbers and letters, less than 32 bits)
     * @var mixed|null
     */
    public $clientOrderId;


    public function __construct($args = array())
    {
        $this->symbol         = $args['symbol'] ?? null;
        $this->side           = $args['side'] ?? null;
        $this->type           = $args['type'] ?? null;
        $this->size           = $args['size'] ?? null;
        $this->price          = $args['price'] ?? null;
        $this->notional       = $args['notional'] ?? null;
        $this->clientOrderId  = $args['clientOrderId'] ?? null;
    }

}