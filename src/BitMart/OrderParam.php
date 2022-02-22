<?php

namespace BitMart;

class OrderParam
{

    public $symbol;
    public $side;
    public $type;
    public $size;
    public $price;
    public $notional;

    public function __construct($symbol, $side, $type, $size, $price, $notional)
    {
        $this->symbol = $symbol;
        $this->side = $side;
        $this->type = $type;
        $this->size = $size;
        $this->price = $price;
        $this->notional = $notional;
    }

}